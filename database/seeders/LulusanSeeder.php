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
                'nim' => '2341760091', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan      
                'nama_lulusan' => 'Aldo Khrisna Wijaya',
                'email_lulusan' => 'khrisnaw03@gmail.com',
                'no_hp_lulusan' => '08123456789',
                'tahun_lulus' => '2015-01-01',
                'sudah_mengisi' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_lulusan' => 2,
                'id_program_studi' => 2,
                'nim' => '2341760134', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan          
                'nama_lulusan' => 'Husein Fadhlullah',
                'email_lulusan' => 'husenfadhullah@gmail.com',
                'no_hp_lulusan' => '08234567890',
                'tahun_lulus' => '2016-01-01',
                'sudah_mengisi' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_lulusan' => 3,
                'id_program_studi' => 3,
                'nim' => '1741770003', //20 -> Tahun Angkatan; 41 -> Jurusan; 760 -> SIB; 720 -> TI; 770 -> PPLS; 001 -> urutan  
                'nama_lulusan' => 'Agus Pratama',
                'email_lulusan' => 'agus@gmail.com',
                'no_hp_lulusan' => '08345678901',
                'tahun_lulus' => '2017-01-01',
                'sudah_mengisi' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}