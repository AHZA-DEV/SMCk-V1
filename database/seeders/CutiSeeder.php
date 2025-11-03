<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;

class CutiSeeder extends Seeder
{
    public function run()
    {
        $cutis = [
            [
                'id_karyawan' => 2,
                'id_jenis_cuti' => 1,
                'tanggal_mulai' => '2023-06-01',
                'tanggal_selesai' => '2023-06-05',
                'jumlah_hari' => 5,
                'alasan' => 'Liburan keluarga',
                'status' => 'disetujui',
                'disetujui_oleh' => 1,
                'disetujui_pada' => '2023-05-25 10:30:00'
            ],
            [
                'id_karyawan' => 3,
                'id_jenis_cuti' => 2,
                'tanggal_mulai' => '2023-07-10',
                'tanggal_selesai' => '2023-07-12',
                'jumlah_hari' => 3,
                'alasan' => 'Sakit demam',
                'status' => 'disetujui',
                'disetujui_oleh' => 1,
                'disetujui_pada' => '2023-07-09 14:15:00'
            ],
            [
                'id_karyawan' => 2,
                'id_jenis_cuti' => 1,
                'tanggal_mulai' => '2023-08-15',
                'tanggal_selesai' => '2023-08-18',
                'jumlah_hari' => 4,
                'alasan' => 'Acara keluarga',
                'status' => 'menunggu'
            ],
            [
                'id_karyawan' => 4,
                'id_jenis_cuti' => 5,
                'tanggal_mulai' => '2023-09-01',
                'tanggal_selesai' => '2023-09-01',
                'jumlah_hari' => 1,
                'alasan' => 'Menikahkan adik',
                'status' => 'disetujui',
                'disetujui_oleh' => 1,
                'disetujui_pada' => '2023-08-28 09:45:00'
            ],
            [
                'id_karyawan' => 5,
                'id_jenis_cuti' => 1,
                'tanggal_mulai' => '2023-10-10',
                'tanggal_selesai' => '2023-10-20',
                'jumlah_hari' => 11,
                'alasan' => 'Liburan panjang',
                'status' => 'ditolak',
                'disetujui_oleh' => 1,
                'disetujui_pada' => '2023-10-05 16:20:00',
                'alasan_penolakan' => 'Kuota cuti tidak mencukupi untuk periode tersebut'
            ]
        ];

        foreach ($cutis as $cuti) {
            Cuti::create($cuti);
        }
    }
}