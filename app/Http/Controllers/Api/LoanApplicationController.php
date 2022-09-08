<?php

namespace App\Http\Controllers\Api;

use App\Models\LoanApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\LoanApplicationRequest;

class LoanApplicationController extends Controller
{
   public function __invoke(LoanApplicationRequest $request)
   {
      
      if(!Gate::allows('isUser'))
      {
         return response()->json([
            'success' => false,
            'message' =>'Only user can make loan request'
         ], 401);
      }
      
      LoanApplication::create([
         'user_id' => $request->user()->id,
         'loan_amount' => $request->loan_amount,
         'loan_tenure' => $request->loan_tenure,
         'loan_intrest_rate' => $request->loan_intrest_rate,
     ]);

      return response()->json([
         'status' => true,
         'message' => 'Loan Application Is Successfully',
     ], 200);
   }
}


