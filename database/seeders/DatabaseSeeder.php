<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $this->call([
        UserSeeder::class,
        KategoriProfesiSeeder::class,
        ProgramStudiSeeder::class,
        ProfesiSeeder::class,
        LulusanSeeder::class,
        StakeholderSeeder::class,
        KuisionerStakeholderSeeder::class,
        KuisionerLulusanSeeder::class,
    ]);
    }
}
