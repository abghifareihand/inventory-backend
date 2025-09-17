<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name'=>'Produk A','description'=>'Deskripsi A','cost_price'=>5000,'selling_price'=>8000],
            ['name'=>'Produk B','description'=>'Deskripsi B','cost_price'=>3000,'selling_price'=>5000],
            ['name'=>'Produk C','description'=>'Deskripsi C','cost_price'=>10000,'selling_price'=>15000],
        ];

        foreach($products as $p) {
            $product = Product::create($p);
            // Stok awal di pusat (branch_id = null)
            Stock::create(['product_id'=>$product->id,'branch_id'=>null,'quantity'=>100]);
        }
    }
}
