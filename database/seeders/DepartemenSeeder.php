<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;

class DepartemenSeeder extends Seeder
{
    public function run()
    {
        $departemens = [
            [
                'kode_departemen' => 'IT',
                'nama_departemen' => 'Teknologi Informasi',
                'deskripsi' => 'Departemen yang menangani teknologi informasi dan sistem'
            ],
            [
                'kode_departemen' => 'HRD',
                'nama_departemen' => 'Sumber Daya Manusia',
                'deskripsi' => 'Departemen yang menangani sumber daya manusia'
            ],
            [
                'kode_departemen' => 'KEU',
                'nama_departemen' => 'Keuangan',
                'deskripsi' => 'Departemen yang menangani keuangan perusahaan'
            ],
            [
                'kode_departemen' => 'MKT',
                'nama_departemen' => 'Pemasaran',
                'deskripsi' => 'Departemen yang menangani pemasaran dan penjualan'
            ],
            [
                'kode_departemen' => 'OPR',
                'nama_departemen' => 'Operasional',
                'deskripsi' => 'Departemen yang menangani operasional perusahaan'
            ]
        ];

        foreach ($departemens as $departemen) {
            Departemen::create($departemen);
        }
    }
}