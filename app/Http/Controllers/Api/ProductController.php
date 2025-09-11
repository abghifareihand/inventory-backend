<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sales = $request->user(); // Sales yang login

        // Ambil stok produk yang bisa dijual, include relasi product
        $stocks = Stock::where('branch_id', $sales->branch_id)
                       ->where('quantity', '>', 0)
                       ->with('product', 'branch')
                       ->get();

        return response()->json([
            'status' => 'success',
            'stocks' => $stocks
        ]);
    }
}
