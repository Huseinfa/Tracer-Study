<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stocks = [];
        
        for ($i = 1; $i <= 10; $i++) {
            $stocks[] = [
                'stok_id' => $i,
                'supplier_id' => rand(1, 10),
                'barang_id' => rand(1, 10),
                'user_id' => 1,
                'stok_tanggal' => now()->subDays(rand(1, 30))->format('Y-m-d H:i:s'),
                'stok_jumlah' => rand(5, 300)
            ];
        }
        
        DB::table('t_stok')->insert($stocks);
    }
}