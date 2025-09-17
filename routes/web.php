<?php

use App\Http\Controllers\AdminPusat\StokController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\Cabang\CabangDashboardController;
use App\Http\Controllers\Web\Cabang\CabangStockController;
use App\Http\Controllers\Web\Cabang\CabangUserController;
use App\Http\Controllers\Web\Owner\OwnerDashboardController;
use App\Http\Controllers\Web\Pusat\PusatBranchController;
use App\Http\Controllers\Web\Pusat\PusatDashboardController;
use App\Http\Controllers\Web\Pusat\PusatStockController;
use App\Http\Controllers\Web\Pusat\PusatUserController;
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
        Route::get('stock/cabang', [PusatStockController::class, 'stockCabang'])->name('pusat.stock.cabang');
        Route::get('stock/sales', [PusatStockController::class, 'stockSales'])->name('pusat.stock.sales');

        // Distribution
        Route::get('stock/{stock}/distribution', [PusatStockController::class, 'distributionForm'])->name('pusat.stock.distribution.form');
        Route::post('stock/distribution', [PusatStockController::class, 'distributionToCabang'])->name('pusat.stock.distribution');

        // Branch
        Route::get('branch', [PusatBranchController::class, 'index'])->name('pusat.branch.index');
        Route::get('branch/create', [PusatBranchController::class, 'create'])->name('pusat.branch.create');
        Route::post('branch', [PusatBranchController::class, 'store'])->name('pusat.branch.store');
        Route::get('branch/{branch}/edit', [PusatBranchController::class, 'edit'])->name('pusat.branch.edit');
        Route::put('branch/{branch}', [PusatBranchController::class, 'update'])->name('pusat.branch.update');
        Route::get('branch/{branch}', [PusatBranchController::class, 'show'])->name('pusat.branch.show');

        // User cabang
        Route::get('user', [PusatUserController::class, 'index'])->name('pusat.user.index');
        Route::get('user/create', [PusatUserController::class, 'create'])->name('pusat.user.create');
        Route::post('user', [PusatUserController::class, 'store'])->name('pusat.user.store');
        Route::get('user/{user}/edit', [PusatUserController::class, 'edit'])->name('pusat.user.edit');
        Route::put('user/{user}', [PusatUserController::class, 'update'])->name('pusat.user.update');
    });

    // ================= CABANG =================
    Route::prefix('cabang')->middleware([RoleMiddleware::class . ':cabang'])->group(function() {
        Route::get('dashboard', [CabangDashboardController::class, 'index'])->name('cabang.dashboard.index');
        Route::get('stock', [CabangStockController::class, 'index'])->name('cabang.stock.index');

        // Distribution
        Route::get('stock/{stock}/distribution', [CabangStockController::class, 'distributionForm'])->name('cabang.stock.distribution.form');
        Route::post('stock/distribution', [CabangStockController::class, 'distributionToSales'])->name('cabang.stock.distribution');

        // User sales
        Route::get('user', [CabangUserController::class, 'index'])->name('cabang.user.index');

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
