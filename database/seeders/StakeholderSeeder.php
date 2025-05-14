<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StakeholderSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_stakeholder')->insert([
            [
                'id_stakeholder' => 1,
                'nama_atasan' => 'Ir. Susi Andayani',
                'instansi' => 'PT Teknologi Abadi',
                'jabatan' => 'Manager HRD',
                'email' => 'hrd@teknologiabadi.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_stakeholder' => 2,
                'nama_atasan' => 'Rudi Hartono',
                'instansi' => 'CV Data Inovatif',
                'jabatan' => 'Kepala Divisi Data',
                'email' => 'rudihartono@cvdatainovatif.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_stakeholder' => 3,
                'nama_atasan' => 'Dian Kusuma, M.Kom',
                'instansi' => 'PT Solusi Digital',
                'jabatan' => 'Project Manager',
                'email' => 'dian.kusuma@solusidigital.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_stakeholder' => 4,
                'nama_atasan' => 'Yulia Ramadhani',
                'instansi' => 'Bank Nusantara',
                'jabatan' => 'HR Recruitment',
                'email' => 'yulia.r@banknusantara.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}