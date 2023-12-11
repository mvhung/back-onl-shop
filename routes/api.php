<?php

use App\Models\UserIdentity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/orders',[OrderController::class, 'store']);

Route::get('/getUserById', [\App\Http\Controllers\UserIdentityController::class, 'getUserIdentityById']);
Route::delete('/deleteUserById', [\App\Http\Controllers\UserIdentityController::class, 'deleteUserById']);
Route::post('/createUser', [\App\Http\Controllers\UserIdentityController::class, 'store']);
Route::put('/updateUser/{id}', [\App\Http\Controllers\UserIdentityController::class, 'update']);
