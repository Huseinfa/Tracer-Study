<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriProfesiSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_kategori_profesi')->insert([
            ['id_kategori_profesi' => 1,'nama_kategori' => 'Bidang Infokom', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori_profesi' => 2,'nama_kategori' => 'Bidang Non Infokom', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori_profesi' => 3,'nama_kategori' => 'Belum Berkerja', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}