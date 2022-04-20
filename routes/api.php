<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\PersonalInformationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
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
//Publikus utak
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::get('/items/search/{name}', [ItemController::class, 'search']);


//Pretektált utak
Route::group(['middleware' => ['auth:sanctum'/* , 'abilities:is-admin' */]], function () {
    
    Route::resource('/reviews', ReviewController::class);
    
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    Route::get('/item/count', [ItemController::class, 'itemCount']);
    
    Route::resource('/categories', CategoryController::class);
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'currentUser']);
    
    Route::resource('/users', UserController::class);
    Route::get('/user/count', [UserController::class, 'userCount']);
    Route::put('/change_password', [UserController::class, 'changePassword']);
    Route::put('/change_username', [UserController::class, 'changeUsername']);
    Route::put('/change_email', [UserController::class, 'changeEmail']);
    
    Route::post('/personal_information', [PersonalInformationController::class, 'store']);
    Route::get('/personal_information', [PersonalInformationController::class, 'show']);
    Route::put('/personal_information/{id}', [PersonalInformationController::class, 'update']);
    Route::delete('/personal_information/{id}', [PersonalInformationController::class, 'destroy']);
    
    Route::get('/order_items', [OrderItemController::class, 'index']);
    Route::get('/order_items/{id}', [OrderItemController::class, 'show']);
    
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/user/orders', [OrderController::class, 'userOrders']);
    Route::put('/orders/{order}', [OrderController::class, 'update']);
    Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
    Route::get('/order/count', [OrderController::class, 'orderCount']);
    Route::get('/order/new/count', [OrderController::class, 'newOrderCount']);
    Route::get('/orders/new', [OrderController::class, 'getNewOrders']);
    Route::post('/orders/new', [OrderController::class, 'order']);
    
});
