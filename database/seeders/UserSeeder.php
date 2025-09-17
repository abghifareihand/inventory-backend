<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner
        User::create([
            'name' => 'Owner A',
            'username' => 'owner',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Admin Pusat
        User::create([
            'name' => 'Admin Pusat',
            'username' => 'pusat',
            'password' => Hash::make('password'),
            'role' => 'pusat',
        ]);

        // Cabang
        $branch1 = Branch::create([
            'name' => 'Cabang Jakarta',
            'address' => 'Jl. Sudirman No.1'
        ]);
        $branch2 = Branch::create([
            'name' => 'Cabang Bandung',
            'address' => 'Jl. Thamrin No.2'
        ]);

        // Admin Cabang
        User::create([
            'name' => 'Admin Jakarta',
            'username' => 'cabangjakarta',
            'password' => Hash::make('password'),
            'role' => 'cabang',
            'branch_id' => $branch1->id
        ]);

        User::create([
            'name' => 'Admin Bandung',
            'username' => 'cabangbandung',
            'password' => Hash::make('password'),
            'role' => 'cabang',
            'branch_id' => $branch2->id
        ]);

        // Sales Cabang Jakarta
        User::create([
            'name' => 'Agus',
            'username' => 'agus',
            'password' => Hash::make('password'),
            'role' => 'sales',
            'branch_id' => $branch1->id
        ]);

        User::create([
            'name' => 'Budi',
            'username' => 'budi',
            'password' => Hash::make('password'),
            'role' => 'sales',
            'branch_id' => $branch1->id
        ]);

        // Sales Cabang Bandung
        User::create([
            'name' => 'Citra',
            'username' => 'citra',
            'password' => Hash::make('password'),
            'role' => 'sales',
            'branch_id' => $branch2->id
        ]);

        User::create([
            'name' => 'Dedi',
            'username' => 'dedi',
            'password' => Hash::make('password'),
            'role' => 'sales',
            'branch_id' => $branch2->id
        ]);
    }
}
