<?php

namespace App\Http\Controllers\Web\Cabang;

use App\Http\Controllers\Controller;
use App\Models\Distribution;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabangStockController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID cabang dari user yang login
        $branchId = Auth::user()->branch_id;

        // Ambil stok yang sudah didistribusikan ke cabang ini
        $stocks = Stock::with('product')
                    ->where('branch_id', $branchId)
                    ->paginate(10);

        return view('pages.cabang.stock.index', compact('stocks'));
    }

    public function distributionForm(Stock $stock)
    {
        // Ambil semua user sales yang terhubung dengan cabang login
        $sales = User::where('branch_id', Auth::user()->branch_id)
                     ->where('role', 'sales')
                     ->get();

        return view('pages.cabang.stock.distribution', compact('stock', 'sales'));
    }

    public function distributionToSales(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'sales_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($request->stock_id);
        $sales = User::findOrFail($request->sales_id);

        if ($request->quantity > $stock->quantity) {
            return redirect()->back()->with('error', 'Stok cabang tidak cukup');
        }

        // Kurangi stok cabang
        $stock->quantity -= $request->quantity;
        $stock->save();

        // Tambah stok ke sales
        $salesStock = Stock::firstOrNew([
            'product_id' => $stock->product_id,
            'branch_id' => $stock->branch_id,
            'sales_id' => $sales->id, // tambahkan kolom sales_id di tabel stocks
        ]);
        $salesStock->quantity += $request->quantity;
        $salesStock->save();

        // Catat distribusi
        Distribution::create([
            'from_branch_id' => $stock->branch_id,
            'to_sales_id' => $sales->id,
            'product_id' => $stock->product_id,
            'quantity' => $request->quantity,
            'type' => 'cabang_to_sales',
        ]);

        return redirect()->route('cabang.stock.index')
                         ->with('success', 'Stok berhasil didistribusikan ke sales ' . $sales->name);
    }
}
