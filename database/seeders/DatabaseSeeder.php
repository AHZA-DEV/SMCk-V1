<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

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