<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outlet::create([
            'name'=>'Toko 1',
            'owner_name'=>'Pak A',
            'phone'=>'08123456789',
            'gps_lat'=>'-6.200',
            'gps_lng'=>'106.816'
        ]);

        Outlet::create([
            'name'=>'Toko 2',
            'owner_name'=>'Bu B',
            'phone'=>'08198765432',
            'gps_lat'=>'-6.201',
            'gps_lng'=>'106.817'
        ]);
    }
}
