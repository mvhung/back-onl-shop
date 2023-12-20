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

Route::get('/message/send', [EmailController::class, 'addFeedback']);
Route::get('/message/sendOTP', [EmailController::class, 'sendOTP']);
Route::get('/message/checkotp', [EmailController::class, 'checkOTP']);
