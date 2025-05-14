<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('t_user')->insert([
            'id_user' => 1,
            'username' => 'admin1',
            'nama_user' => 'Admin Utama',
            'password' => Hash::make('12345'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}