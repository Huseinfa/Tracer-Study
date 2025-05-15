<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LulusanSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_lulusan')->insert([
            [
                'id_lulusan' => 1,
                'id_program_studi' => 1,
                'nim' => '1541720001', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan      
                'nama_lulusan' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'nomor_hp' => '08123456789',
                'tanggal_lulus' => '2015-01-01',
                'foto_profil' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_lulusan' => 2,
                'id_program_studi' => 2,
                'nim' => '1641760002', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan          
                'nama_lulusan' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'nomor_hp' => '08234567890',
                'tanggal_lulus' => '2016-01-01',
                'foto_profil' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_lulusan' => 3,
                'id_program_studi' => 3,
                'nim' => '1741770003', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan  
                'nama_lulusan' => 'Agus Pratama',
                'email' => 'agus@gmail.com',
                'nomor_hp' => '08345678901',
                'tanggal_lulus' => '2017-01-01',
                'foto_profil' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}