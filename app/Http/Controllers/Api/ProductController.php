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

        // Ambil stok untuk sales ini beserta product
        $stocks = Stock::where('sales_id', $sales->id)
                    ->with('product')
                    ->get();

        // Format output supaya ada info produk + quantity
        $products = $stocks->map(function($stock) {
            return [
                'id' => $stock->product->id,
                'name' => $stock->product->name,
                'description' => $stock->product->description,
                'cost_price' => $stock->product->cost_price,
                'selling_price' => $stock->product->selling_price,
                'quantity' => $stock->quantity
            ];
        });

        return response()->json([
            'status' => 'success',
            'products' => $products
        ]);
    }
}
