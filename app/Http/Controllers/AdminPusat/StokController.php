<?php

namespace App\Http\Controllers\AdminPusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Distribution;

class StokController extends Controller
{
    // 1. Daftar stok pusat
    public function index()
    {
        // Ambil stok pusat (branch_id = null)
      $stocks = Stock::with('product')
               ->whereNull('branch_id')
               ->when(request('keyword'), function($query) {
                   $query->whereHas('product', function($q) {
                       $q->where('name', 'like', '%'.request('keyword').'%');
                   });
               })
               ->paginate(10); 
        return view('pages.pusat.stok.index', compact('stocks'));
    }

    // 2. Form tambah stok baru
    public function create()
    {
        $products = Product::all();
        return view('admin_pusat.stok.create', compact('products'));
    }

    // 3. Simpan stok baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Jika produk sudah ada di stok pusat, update qty
        $stock = Stock::firstOrNew([
            'product_id' => $request->product_id,
            'branch_id' => null,
        ]);

        $stock->quantity += $request->quantity;
        $stock->save();

        return redirect()->route('admin_pusat.stok.index')->with('success', 'Stok berhasil ditambahkan');
    }

    // 4. Form edit stok
    public function edit(Stock $stock)
    {
        $products = Product::all();
        return view('admin_pusat.stok.edit', compact('stock', 'products'));
    }

    // 5. Update stok
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $stock->quantity = $request->quantity;
        $stock->save();

        return redirect()->route('admin_pusat.stok.index')->with('success', 'Stok berhasil diperbarui');
    }

    // 6. Hapus stok
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('admin_pusat.stok.index')->with('success', 'Stok berhasil dihapus');
    }

    // 7. Distribusi stok ke cabang
    public function distribusi(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'branch_id' => 'required|exists:branches,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($request->stock_id);

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

        return redirect()->back()->with('success', 'Stok berhasil didistribusikan ke cabang');
    }
}
