<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum','admin')->group(function(){

    Route::get('/user', [AuthController::class,'getUser']);

    Route::post('/logout',[AuthController::class,'logout']);

    Route::apiResource('products', ProductController::class);
    Route::get('orders', [OrderController::class,'index']);
    Route::get('order/statuses', [OrderController::class,'getStatus']);
    Route::post('order/change-status/{order}/{status}', [OrderController::class,'changeStatus']);
    Route::get('order/{order}', [OrderController::class,'view']);

});

Route::post('/login',[AuthController::class,'login']);
