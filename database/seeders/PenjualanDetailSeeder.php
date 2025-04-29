<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) { // loop 10 transaksi
            $itemDipilih = array_rand(range(1, 10), 3); // 3 item random per transaksi
            foreach ($itemDipilih    as $index) {
                $barang_id = $index + 1; // ubah index ke barang_id yang tersedia/valid
                $harga = DB::table('m_barang')->where('barang_id', $barang_id)->value('harga_jual'); // get harga jual
                $data[] = [
                    'detail_id' => count($data) + 1, // auto increment untuk detail_id
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id, // item yang telah dirandom
                    'harga' => $harga, // harga yang didapatkan sebelumnya
                    'jumlah' => rand(1, 5), // jumlah random
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
