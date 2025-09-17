<?php

use App\Http\Controllers\AdminPusat\StokController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\Cabang\CabangDashboardController;
use App\Http\Controllers\Web\Cabang\CabangStockController;
use App\Http\Controllers\Web\Owner\OwnerDashboardController;
use App\Http\Controllers\Web\Pusat\PusatDashboardController;
use App\Http\Controllers\Web\Pusat\PusatStockController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Login routes
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Semua route harus login
Route::middleware(['auth'])->group(function () {

    // ================= OWNER =================
    Route::prefix('owner')->middleware([RoleMiddleware::class . ':owner'])->group(function() {
        Route::get('dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard.index');
    });

    // ================= PUSAT =================
    Route::prefix('pusat')->middleware([RoleMiddleware::class . ':pusat'])->group(function() {
        Route::get('dashboard', [PusatDashboardController::class, 'index'])->name('pusat.dashboard.index');
        Route::get('stock', [PusatStockController::class, 'index'])->name('pusat.stock.index');

        // Distribution
        Route::get('stock/{stock}/distribution', [PusatStockController::class, 'distributionForm'])->name('pusat.stock.distribution.form');
        Route::post('stock/distribution', [PusatStockController::class, 'distributionToCabang'])->name('pusat.stock.distribution');
    });

    // ================= CABANG =================
    Route::prefix('cabang')->middleware([RoleMiddleware::class . ':cabang'])->group(function() {
        Route::get('dashboard', [CabangDashboardController::class, 'index'])->name('cabang.dashboard.index');
        Route::get('stock', [CabangStockController::class, 'index'])->name('cabang.stock.index');

        // Distribution
        Route::get('stock/{stock}/distribution', [CabangStockController::class, 'distributionForm'])->name('cabang.stock.distribution.form');
        Route::post('stock/distribution', [CabangStockController::class, 'distributionToSales'])->name('cabang.stock.distribution');

    });

    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('pusat')->middleware(['auth', RoleMiddleware::class.':pusat'])->group(function() {
    Route::get('stok', [StokController::class, 'index'])->name('pusat.stok.index');
    Route::get('stok/create', [StokController::class, 'create'])->name('pusat.stok.create');
    Route::post('stok', [StokController::class, 'store'])->name('pusat.stok.store');
    Route::get('stok/{stock}/edit', [StokController::class, 'edit'])->name('pusat.stok.edit');
    Route::put('stok/{stock}', [StokController::class, 'update'])->name('pusat.stok.update');
    Route::delete('stok/{stock}', [StokController::class, 'destroy'])->name('pusat.stok.destroy');

    // Distribusi stok ke cabang
    Route::post('stok/distribusi', [StokController::class, 'distribusi'])->name('pusat.stok.distribusi');
});
