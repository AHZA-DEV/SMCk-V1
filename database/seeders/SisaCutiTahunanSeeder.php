<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SisaCutiTahunan;

class SisaCutiTahunanSeeder extends Seeder
{
    public function run()
    {
        $sisaCutis = [
            [
                'id_karyawan' => 2,
                'tahun' => 2023,
                'sisa_cuti' => 10
            ],
            [
                'id_karyawan' => 3,
                'tahun' => 2023,
                'sisa_cuti' => 8
            ],
            [
                'id_karyawan' => 4,
                'tahun' => 2023,
                'sisa_cuti' => 5
            ],
            [
                'id_karyawan' => 5,
                'tahun' => 2023,
                'sisa_cuti' => 12
            ]
        ];

        foreach ($sisaCutis as $sisaCuti) {
            SisaCutiTahunan::create($sisaCuti);
        }
    }
}