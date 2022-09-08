<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoanApplicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/loan-application', LoanApplicationController::class)->name('loan-application');
    Route::get('/loans', [UserController::class, 'index'])->name('loans');
    Route::post('/loan-emi', [UserController::class, 'payloanemi'])->name('loan-emi');
    Route::get('/admin/loan-applications', [AdminController::class, 'index']);
    Route::post('/admin/update-loan-status', [AdminController::class, 'update']);
    Route::get('user-transcation', [UserController::class, 'loanTransactions']);
    
});


