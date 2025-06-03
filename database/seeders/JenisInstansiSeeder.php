<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisInstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_jenis_instansi')->insert([
            ['id_jenis_instansi' => 1, 'nama_jenis_instansi' => 'Pendidikan Tinggi', 'created_at' => now(), 'updated_at' => now()],
            ['id_jenis_instansi' => 2, 'nama_jenis_instansi' => 'Instansi Pemerintah', 'created_at' => now(), 'updated_at' => now()],
            ['id_jenis_instansi' => 3, 'nama_jenis_instansi' => 'Badan Usaha Milik Negara (BUMN)', 'created_at' => now(), 'updated_at' => now()],
            ['id_jenis_instansi' => 4, 'nama_jenis_instansi' => 'Perusahaan Swasta', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
