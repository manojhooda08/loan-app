<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(UserLoginRequest $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'User Logged In Successfully',
            'token' => Auth::User()->createToken("API TOKEN")->plainTextToken
        ], 200);
        
    }
    
}
