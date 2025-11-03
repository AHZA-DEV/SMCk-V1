<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notifikasi;

class NotifikasiSeeder extends Seeder
{
    public function run()
    {
        $notifikasis = [
            [
                'id_karyawan' => 1,
                'judul' => 'Pengajuan Cuti Baru',
                'pesan' => 'Budi Santoso mengajukan cuti pada tanggal 15-18 Agustus 2023',
                'sudah_dibaca' => false,
                'tautan' => '/admin/cuti.php'
            ],
            [
                'id_karyawan' => 2,
                'judul' => 'Cuti Disetujui',
                'pesan' => 'Pengajuan cuti Anda pada tanggal 1-5 Juni 2023 telah disetujui',
                'sudah_dibaca' => true,
                'tautan' => '/karyawan/cuti/riwayat.php'
            ],
            [
                'id_karyawan' => 3,
                'judul' => 'Cuti Disetujui',
                'pesan' => 'Pengajuan cuti sakit Anda pada tanggal 10-12 Juli 2023 telah disetujui',
                'sudah_dibaca' => true,
                'tautan' => '/karyawan/cuti/riwayat.php'
            ],
            [
                'id_karyawan' => 4,
                'judul' => 'Cuti Disetujui',
                'pesan' => 'Pengajuan cuti penting Anda pada tanggal 1 September 2023 telah disetujui',
                'sudah_dibaca' => false,
                'tautan' => '/karyawan/cuti/riwayat.php'
            ],
            [
                'id_karyawan' => 5,
                'judul' => 'Cuti Ditolak',
                'pesan' => 'Pengajuan cuti Anda pada tanggal 10-20 Oktober 2023 telah ditolak',
                'sudah_dibaca' => false,
                'tautan' => '/karyawan/cuti/riwayat.php'
            ]
        ];

        foreach ($notifikasis as $notifikasi) {
            Notifikasi::create($notifikasi);
        }
    }
}