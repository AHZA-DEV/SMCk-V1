<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SisaCutiTahunan;

class SisaCutiTahunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sisaCutis = [
            [
                'karyawan_id' => 2,
                'tahun' => 2023,
                'sisa_cuti' => 10
            ],
            [
                'karyawan_id' => 3,
                'tahun' => 2023,
                'sisa_cuti' => 8
            ],
            [
                'karyawan_id' => 4,
                'tahun' => 2023,
                'sisa_cuti' => 5
            ],
            [
                'karyawan_id' => 5,
                'tahun' => 2023,
                'sisa_cuti' => 12
            ]
        ];

        foreach ($sisaCutis as $sisaCuti) {
            SisaCutiTahunan::create($sisaCuti);
        }
    }
}
