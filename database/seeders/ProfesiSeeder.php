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
            ['id_profesi' => 1, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Developer/Programmer/Software Engineer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 2, 'id_kategori_profesi' => 1, 'nama_profesi' => 'IT Support/IT Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 3, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Infrastructure Engineer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 4, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Digital Marketing Specialist', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 5, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Graphic Designer/Multimedia Designer', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 6, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Business Analyst', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 7, 'id_kategori_profesi' => 1, 'nama_profesi' => 'QA Engineer/Tester', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 8, 'id_kategori_profesi' => 1, 'nama_profesi' => 'IT Enterpreneur', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 9, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Trainer/Guru/Dosen (IT)', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 10, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 11, 'id_kategori_profesi' => 1, 'nama_profesi' => 'Lainnya....', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 12, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Procurement & Operational Team', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 13, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Wirausahawan (Non IT)', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 14, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Trainer/Guru/Dosen (Non IT)', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 15, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Mahasiswa', 'created_at' => now(), 'updated_at' => now()],
            ['id_profesi' => 16, 'id_kategori_profesi' => 2, 'nama_profesi' => 'Lainnya....', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}