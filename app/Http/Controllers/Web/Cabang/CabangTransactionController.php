<?php

namespace App\Http\Controllers\Web\Cabang;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabangTransactionController extends Controller
{
    // Tampilkan daftar transaksi sales cabang
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $transactions = Transaction::whereHas('sales', function($q) use ($branchId) {
                                $q->where('branch_id', $branchId);
                            })
                            ->with('sales', 'outlet', 'items.product')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('pages.cabang.transaction.index', compact('transactions'));
    }

    // Detail transaksi
    public function show(Transaction $transaction)
    {
        $branchId = Auth::user()->branch_id;

        // Pastikan transaksi berasal dari sales cabang login
        if($transaction->sales->branch_id != $branchId){
            abort(403);
        }

        $transaction->load('sales', 'outlet', 'items.product');

        return view('pages.cabang.transaction.show', compact('transaction'));
    }
}
