<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/orders',[OrderController::class, 'index']);
Route::get('/orders',[OrderController::class, 'index']);
Route::post('/orders',[OrderController::class, 'store']);

Route::get('/orders/send-email', [EmailController::class, 'addFeedback']);
Route::get('/authenticate/create-otp', [EmailController::class, 'sendOTP']);
Route::get('/authenticate/verify-otp', [EmailController::class, 'checkOTP']);
