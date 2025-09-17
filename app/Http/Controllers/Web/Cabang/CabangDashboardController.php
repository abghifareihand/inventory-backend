<?php

namespace App\Http\Controllers\Web\Cabang;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabangDashboardController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id;

        // Hitung total produk unik di cabang ini
        $totalProduct = Stock::where('branch_id', $branchId)
                            ->distinct('product_id')
                            ->count('product_id');

        // Hitung total sales di cabang ini
        $totalSales = User::where('role', 'sales')
                        ->where('branch_id', $branchId)
                        ->count();

        return view('pages.cabang.dashboard', compact('totalProduct','totalSales'));
    }
}
