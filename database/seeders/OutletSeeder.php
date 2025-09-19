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
            'latitude'=>'-6.200',
            'longitude'=>'106.816'
        ]);

        Outlet::create([
            'name'=>'Toko 2',
            'owner_name'=>'Bu B',
            'phone'=>'08198765432',
            'latitude'=>'-6.201',
            'longitude'=>'106.817'
        ]);
    }
}
