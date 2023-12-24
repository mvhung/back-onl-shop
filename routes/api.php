<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
use App\Models\Orders;
use App\Models\ShoppingCart;
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
    Route::post('authenticate', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'middleware' => 'auth:api'], function() {
    Route::get("categories/getAll", [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/authenticate/get-user', [AuthController::class, 'getUser']);
    Route::get('authenticate/get-all-users', [AuthController::class, 'getAllUser']);
    Route::delete('/authenticate/delete-user/{email}',[AuthController::class,'deleteUser']);
    //order
    Route::post('/orders/create',[OrderController::class, 'store']);
    Route::get('/orders/get-order',[OrderController::class, 'getOrderByCartId']);
    Route::get('/orders/filter-orders',[OrderController::class, 'filterOrders']);
    Route::get('/orders/load-more-orders',[OrderController::class, 'filterOrders']);
    //placed order
    Route::get('/orders/get-orders/placed',[OrderController::class,'getPlacedOrders']);
    Route::get('/orders/admin-get-orders',[OrderController::class,'getAllPlacedOrders']);

    Route::get('/getUserById', [\App\Http\Controllers\UserIdentityController::class, 'getUserIdentityById']);
    Route::delete('/deleteUserById', [\App\Http\Controllers\UserIdentityController::class, 'deleteUserById']);
    Route::post('/createUser', [\App\Http\Controllers\UserIdentityController::class, 'store']);
    Route::put('/updateUser/{id}', [\App\Http\Controllers\UserIdentityController::class, 'update']);
    // product
    Route::get('/products/getAll',[ProductController::class,'index']);
    Route::get('/products/get',[ProductController::class,'getProductById']);
    Route::delete('/products/delete/{productId}',[ProductController::class,'deleteProductById']);
    Route::post('/products/create',[ProductController::class,'store']);
    Route::put('/products/update',[ProductController::class,'update']);
    Route::get('/products/getByCategory',[ProductController::class,'getProductByCategory']);

// shopping cart
    Route::post('/shopping-cart/new-cart',[ShoppingCartController::class,'createShoppingCart']);
    Route::post('/shopping-cart/update-cart',[ShoppingCartController::class,'updateShoppingCart']);
    Route::delete('/shopping-cart/clear-cart',[ShoppingCartController::class,'deleteShoppingCart']);
//    Route::get('/shopping-cart/getById',[ShoppingCartController::class,'getByCartId']);
    Route::delete('/shopping-cart/clear-shopping-cart/{id}',[ShoppingCartController::class,'clearShoppingCart']);
    Route::get('/shopping-cart/getById',[ShoppingCartController::class,'getShoppingCartDetail']);
    //email
//    Route::get('/message/send', [EmailController::class, 'addFeedback']);
});



