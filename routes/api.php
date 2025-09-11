<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('sales')->group(function() {
    Route::post('login', [AuthController::class,'login']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('dashboard', [DashboardController::class,'index']);
        Route::get('products', [ProductController::class,'index']);

        Route::post('transactions', [TransactionController::class,'store']);
        Route::get('transactions', [TransactionController::class,'index']);

        Route::get('outlets', [OutletController::class,'index']);
        Route::post('outlets', [OutletController::class,'store']);

        Route::get('distributions', [DashboardController::class,'distributions']);
    });
});
