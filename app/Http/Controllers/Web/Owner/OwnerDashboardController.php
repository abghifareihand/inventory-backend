<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count();
        $totalCabang  = User::where('role', 'cabang')->count();
        $totalSales   = User::where('role', 'sales')->count();

        return view('pages.owner.dashboard', compact('totalProduct', 'totalCabang', 'totalSales'));
    }
}
