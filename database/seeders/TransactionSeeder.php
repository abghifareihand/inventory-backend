<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = User::where('role','sales')->first();
        $outlet = Outlet::first();

        $transaction = Transaction::create([
            'sales_id'=>$sales->id,
            'outlet_id'=>$outlet->id,
            'total'=>15000,
            'profit'=>5000,
            'gps_lat'=>'-6.200',
            'gps_lng'=>'106.816',
        ]);

        TransactionItem::create([
            'transaction_id'=>$transaction->id,
            'product_id'=>Product::first()->id,
            'quantity'=>1,
            'price'=>8000,
            'cost_price'=>5000
        ]);

        TransactionItem::create([
            'transaction_id'=>$transaction->id,
            'product_id'=>Product::skip(1)->first()->id,
            'quantity'=>1,
            'price'=>7000,
            'cost_price'=>5000
        ]);
    }
}
