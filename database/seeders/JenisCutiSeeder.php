<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisCuti;

class JenisCutiSeeder extends Seeder
{
    public function run()
    {
        $jenisCutis = [
            [
                'kode_cuti' => 'CT001',
                'nama_cuti' => 'Cuti Tahunan',
                'deskripsi' => 'Cuti tahunan karyawan',
                'maksimal_hari' => 12,
                'is_dibayar' => true
            ],
            [
                'kode_cuti' => 'CT002',
                'nama_cuti' => 'Cuti Sakit',
                'deskripsi' => 'Cuti karena sakit dengan surat dokter',
                'maksimal_hari' => 30,
                'is_dibayar' => true
            ],
            [
                'kode_cuti' => 'CT003',
                'nama_cuti' => 'Cuti Melahirkan',
                'deskripsi' => 'Cuti untuk melahirkan',
                'maksimal_hari' => 90,
                'is_dibayar' => true
            ],
            [
                'kode_cuti' => 'CT004',
                'nama_cuti' => 'Cuti Besar',
                'deskripsi' => 'Cuti besar setelah bekerja minimal 5 tahun',
                'maksimal_hari' => 60,
                'is_dibayar' => true
            ],
            [
                'kode_cuti' => 'CT005',
                'nama_cuti' => 'Cuti Penting',
                'deskripsi' => 'Cuti untuk keperluan penting (menikah, khitanan, dll)',
                'maksimal_hari' => 3,
                'is_dibayar' => true
            ],
            [
                'kode_cuti' => 'CT006',
                'nama_cuti' => 'Cuti Diluar Tanggungan',
                'deskripsi' => 'Cuti tanpa dibayar',
                'maksimal_hari' => 30,
                'is_dibayar' => false
            ]
        ];

        foreach ($jenisCutis as $jenisCuti) {
            JenisCuti::create($jenisCuti);
        }
    }
}