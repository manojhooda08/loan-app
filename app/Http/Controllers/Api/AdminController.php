<?php

namespace App\Http\Controllers\Api;

use App\Models\LoanEmi;
use Illuminate\Http\Request;
use App\Mail\LoanApprovedMail;
use App\Models\LoanApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\LoanApllicationResource;
use App\Http\Requests\UpdateLoanApplicationRequest;
use PDF;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(!Gate::allows('isAdmin'))
        {
            return response()->json([
                'success' => false,
                'message' => 'Only administrator can access this endpoint',
            ], 401);
        }
        
       // $result = LoanApplication::with('user')->get();
        return response()->json([
            'success' => true,
            'data' => LoanApllicationResource::collection(LoanApplication::all()),
        ],200);

    }

    public function update(UpdateLoanApplicationRequest $request)
    {
        $payload = $request->only('loan_id', 'status_id', 'description');
        LoanApplication::where('id', $payload['loan_id'])
        ->update(['status_id'=> $payload['status_id'], 'description'=> $payload['description']]);
       
        $userloan = LoanApplication::where('id', $payload['loan_id'])->with('user')->first();
        
        if($userloan->status_id==2)
        {
           $userloan->loanemi = $emi = $this->emiCalculator($userloan->loan_amount,$userloan->loan_intrest_rate, $userloan->loan_tenure);
           LoanEmi::create([
                'loan_application_id' => $userloan->id,
                'monthly_emi' => $emi,
                'outstanding_amount' =>($emi*$userloan->loan_tenure),
                'outstanding_emis' =>$userloan->loan_tenure,
                'emi_date' => now()->addMonth(1)->toDateString(),
            ]);
           

            $data = $userloan->toArray();
            $pdfname = storage_path('app/public/loans/'.$payload['loan_id'].'_loan_details.pdf');
            $pdf = PDF::loadView('loanpdf', $data);
            $pdf->save($pdfname);
            Mail::to($userloan->user)->queue(new LoanApprovedMail($userloan, $pdfname));

        }

        return response()->json([
            'success' => true,
            'data' => 'Loan Application Status Updated',
        ],200);
    }

    public function emiCalculator($amount, $rate, $time)
    {
        $emi = 0; 
        $rate = $rate / (12 * 100);   // one month interest 
        
        $emi = ($amount * $rate * pow(1 + $rate, $time)) /  
                      (pow(1 + $rate, $time) - 1); 

        return round($emi);
      
    }
}
