<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DepartemenSeeder::class,
            JenisCutiSeeder::class,
            KaryawanSeeder::class,
            CutiSeeder::class,
            NotifikasiSeeder::class,
            PengaturanSistemSeeder::class,
            SisaCutiTahunanSeeder::class,
        ]);
    }
}