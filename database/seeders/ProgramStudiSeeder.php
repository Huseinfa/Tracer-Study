<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_program_studi')->insert([
            ['id_program_studi' => 1, 'nama_prodi' => 'D4 Teknik Informatika', 'created_at' => now(), 'updated_at' => now()],
            ['id_program_studi' => 2, 'nama_prodi' => 'D4 Sistem Informasi Bisnis', 'created_at' => now(), 'updated_at' => now()],
            ['id_program_studi' => 3, 'nama_prodi' => 'D2 Pengembangan Piranti Lunak Situs', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}