<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [];
        $names = ['PT. Alpha', 'PT. Beta', 'PT. Gamma', 'PT. Delta', 'PT. Epsilon', 'PT. Zeta', 'PT. Eta', 'PT. Theta', 'PT. Iota', 'PT. Kappa'];
        shuffle($names);
        
        for ($i = 1; $i <= 10; $i++) {
            $suppliers[] = [
                'supplier_id' => $i,
                'supplier_kode' => 'S' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'supplier_nama' => $names[$i - 1],
                'supplier_alamat' => 'Jl. ' . chr(64 + $i) . ' No. ' . rand(1, 100)
            ];
        }
        
        DB::table('m_supplier')->insert($suppliers);
    }
}
        