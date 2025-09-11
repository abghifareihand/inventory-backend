<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transactions = Transaction::where('sales_id',$request->user()->id)
            ->with('items.product','outlet')->get();
        return response()->json($transactions);
    }

    public function store(Request $request){
        $request->validate([
            'outlet_id'=>'required|exists:outlets,id',
            'items'=>'required|array',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.quantity'=>'required|integer|min:1',
            'gps_lat'=>'required|string',
            'gps_lng'=>'required|string'
        ]);

        $total = 0;
        $transaction = Transaction::create([
            'sales_id'=>$request->user()->id,
            'outlet_id'=>$request->outlet_id,
            'branch_id'=>$request->user()->branch_id,
            'gps_lat'=>$request->gps_lat,
            'gps_lng'=>$request->gps_lng,
            'total'=>0, // nanti update
            'profit'=>0
        ]);

        foreach($request->items as $item){
            $product = \App\Models\Product::find($item['product_id']);
            $price = $product->selling_price;
            $cost = $product->cost_price;

            TransactionItem::create([
                'transaction_id'=>$transaction->id,
                'product_id'=>$product->id,
                'quantity'=>$item['quantity'],
                'price'=>$price,
                'cost_price'=>$cost
            ]);

            $total += $price * $item['quantity'];
        }

        $transaction->update(['total'=>$total,'profit'=>$transaction->profit]);
        return response()->json($transaction->load('items.product','outlet'));
    }
}
