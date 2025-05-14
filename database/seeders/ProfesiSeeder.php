<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesiSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_profesi')->insert([
            ['id_profesi' => 1, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Software Developer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 2, 'id_kategori_profesi' => 1, 'nama_profesi' => 'IT Support', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 3, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Mobile APP Developer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 4, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Game Developer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 5, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Security Engineer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 6, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Data Analyst', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 7, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Data Scientist', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 8, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Business Analyst', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 9, 'id_kategori_profesi' => 2, 'nama_profesi' => 'SEO Specialist', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 10, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Software Engineer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 11, 'id_kategori_profesi' => 3, 'nama_profesi' => 'Technoprenuer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 12, 'id_kategori_profesi' => 3, 'nama_profesi' => 'Full Stack Web Developer', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}