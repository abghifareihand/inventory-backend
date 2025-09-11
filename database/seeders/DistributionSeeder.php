<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Distribution;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil cabang
        $branchJakarta = Branch::where('name', 'Cabang Jakarta')->first();
        $branchBandung = Branch::where('name', 'Cabang Bandung')->first();

        // Ambil sales berdasarkan cabang
        $salesJakarta = User::where('role', 'sales')->where('branch_id', $branchJakarta->id)->get();
        $salesBandung = User::where('role', 'sales')->where('branch_id', $branchBandung->id)->get();

        // Loop semua produk
        foreach(Product::all() as $product){
            // Pusat → Cabang Jakarta
            Distribution::create([
                'from_branch_id' => null,
                'to_branch_id'   => $branchJakarta->id,
                'product_id'     => $product->id,
                'quantity'       => 20,
                'type'           => 'pusat_to_cabang',
                'notes'          => "Distribusi dari Pusat ke Cabang Jakarta"
            ]);

            // Pusat → Cabang Bandung
            Distribution::create([
                'from_branch_id' => null,
                'to_branch_id'   => $branchBandung->id,
                'product_id'     => $product->id,
                'quantity'       => 20,
                'type'           => 'pusat_to_cabang',
                'notes'          => "Distribusi dari Pusat ke Cabang Bandung"
            ]);

            // Cabang Jakarta → Sales Jakarta
            foreach($salesJakarta as $sales){
                Distribution::create([
                    'from_branch_id' => $branchJakarta->id,
                    'to_sales_id'    => $sales->id,
                    'product_id'     => $product->id,
                    'quantity'       => 10,
                    'type'           => 'cabang_to_sales',
                    'notes'          => "Distribusi dari Cabang Jakarta ke Sales {$sales->name}"
                ]);
            }

            // Cabang Bandung → Sales Bandung -> Dedi
            foreach($salesBandung as $sales){
                $distribution = Distribution::create([
                    'from_branch_id' => $branchBandung->id,
                    'to_sales_id'    => $sales->id,
                    'product_id'     => $product->id,
                    'quantity'       => 10,
                    'type'           => 'cabang_to_sales',
                    'notes'          => "Distribusi dari Cabang Bandung ke Sales {$sales->name}"
                ]);
                // Update stok Sales Dedi
                $stock = Stock::firstOrCreate([
                    'branch_id'  => $sales->branch_id,
                    'product_id' => $product->id
                ], ['quantity' => 0]);

                $stock->quantity += $distribution->quantity;
                $stock->save();
            }
        }
    }
}
