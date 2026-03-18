<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeOrderController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/products',  [ProductController::class, 'index']);
    Route::get('/product/{slug}',  [ProductController::class, 'product_details']);
    Route::post('/order',  [OrderController::class, 'store']);
    Route::get('/orderStatus/{id}',  [OrderController::class, 'order_status']);
    Route::patch('/orders/{id}/cancel', [OrderController::class, 'cancel']);
});

Route::middleware(['auth:api', 'employee'])->prefix('employee')->group(function () {
    Route::get('/orders',                   [EmployeeOrderController::class, 'index']);
    Route::patch('/orders/{id}/prepare',    [EmployeeOrderController::class, 'prepare']);
    Route::patch('/orders/{id}/deliver',    [EmployeeOrderController::class, 'deliver']);
});