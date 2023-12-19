<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'middleware' => 'auth:api'], function() {
    Route::post('/orders',[OrderController::class, 'store']);
    Route::get('/orders/getOrderbyCartId',[OrderController::class, 'getOrderByCartId']);
    Route::get('/getUserById', [\App\Http\Controllers\UserIdentityController::class, 'getUserIdentityById']);
    Route::delete('/deleteUserById', [\App\Http\Controllers\UserIdentityController::class, 'deleteUserById']);
    Route::post('/createUser', [\App\Http\Controllers\UserIdentityController::class, 'store']);
    Route::put('/updateUser/{id}', [\App\Http\Controllers\UserIdentityController::class, 'update']);
    Route::get('/getAllCategories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/product/getbycategory',[ProductController::class,'getProductByCategory']);
    // shopping cart
    Route::post('/shoppingcart/creatshoppingcartbycartid',[ShoppingCartController::class,'createShoppingCart']);
    Route::put('/shoppingcart/updateshoppingcart',[ShoppingCartController::class,'updateShoppingCart']);
    Route::delete('/shoppingcart/deleteshoppingcart',[ShoppingCartController::class,'deleteShoppingCart']);
    Route::post('/message/send', [EmailController::class, 'addFeedback']);
});
