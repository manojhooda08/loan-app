<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use App\Models\LoanTransaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoanApllicationResource;
use App\Mail\LoanApproved;
use App\Models\LoanEmi;

class UserController extends Controller
{
    function index(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => LoanApllicationResource::collection($request->user()->loans),
        ], 200);

    }

    public function payloanemi(Request $request)
    {
        $Loan = LoanApplication::with('emi')->find($request->loan_application_id);
        if($Loan->emi->outstanding_emis>0)
        {
            LoanTransaction::create([
                'user_id' => $request->user()->id,
                'loan_application_id' => $Loan->emi->loan_application_id,
                'amount' => $Loan->emi->monthly_emi,
                'trans_status' => 'success',

            ]);

            LoanEmi::where('id', $Loan->emi->id)
            ->update([
                'outstanding_amount' => ($Loan->emi->outstanding_amount-$Loan->emi->monthly_emi), 
                'outstanding_emis' => ($Loan->emi->outstanding_emis-1), 
                'emi_date' => now()->addMonth(1)->toDateString(),
            ]);

        }

        return response()->json([
            'status' => true,
            'data' => 'Your transaction is successful',
        ], 200);
       
       
    }

    public function loanTransactions(Request $request)
    {
        
        $result = LoanApplication::with('transactions')->find($request->loan_application_id);
        // $result->load('transactions');
        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }
}
