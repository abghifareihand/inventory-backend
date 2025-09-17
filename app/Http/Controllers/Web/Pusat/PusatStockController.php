<?php

namespace App\Http\Controllers\Web\Pusat;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Distribution;
use App\Models\Stock;
use Illuminate\Http\Request;

class PusatStockController extends Controller
{
    public function index()
    {
        // Ambil stok pusat (branch_id = null)
        $stocks = Stock::with('product')
                    ->whereNull('branch_id')
                    ->paginate(10);

        return view('pages.pusat.stock.index', compact('stocks'));
    }

    public function distributionForm(Stock $stock)
    {
        $branches = Branch::all();
        return view('pages.pusat.stock.distribution', compact('stock', 'branches'));
    }

    public function distributionToCabang(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'branch_id' => 'required|exists:branches,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($request->stock_id);
        $branch = Branch::findOrFail($request->branch_id);

        if($request->quantity > $stock->quantity) {
            return redirect()->back()->with('error', 'Stok pusat tidak cukup');
        }

        // Kurangi stok pusat
        $stock->quantity -= $request->quantity;
        $stock->save();

        // Tambah stok ke cabang
        $branchStock = Stock::firstOrNew([
            'product_id' => $stock->product_id,
            'branch_id' => $request->branch_id,
        ]);
        $branchStock->quantity += $request->quantity;
        $branchStock->save();

        // Catat distribusi
        Distribution::create([
            'from_branch_id' => null,
            'to_branch_id' => $request->branch_id,
            'product_id' => $stock->product_id,
            'quantity' => $request->quantity,
            'type' => 'pusat_to_cabang',
        ]);

        return redirect()->route('pusat.stock.index')->with('success', 'Stok berhasil didistribusikan ke cabang ' . $branch->name);

    }

}
