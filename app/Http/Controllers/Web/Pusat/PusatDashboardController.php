<?php

namespace App\Http\Controllers\Web\Pusat;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PusatDashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count();
        $totalCabang = User::where('role', 'cabang')->count();
        return view('pages.pusat.dashboard', compact('totalProduct', 'totalCabang'));
    }
}
