<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret')
        ]);

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
