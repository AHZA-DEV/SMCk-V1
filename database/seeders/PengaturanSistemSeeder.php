<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaturanSistem;

class PengaturanSistemSeeder extends Seeder
{
    public function run()
    {
        $pengaturans = [
            [
                'kunci_pengaturan' => 'nama_perusahaan',
                'nilai_pengaturan' => 'PT. Contoh Perusahaan',
                'deskripsi' => 'Nama perusahaan'
            ],
            [
                'kunci_pengaturan' => 'alamat_perusahaan',
                'nilai_pengaturan' => 'Jl. Contoh No. 123, Jakarta',
                'deskripsi' => 'Alamat perusahaan'
            ],
            [
                'kunci_pengaturan' => 'max_cuti_tahunan',
                'nilai_pengaturan' => '12',
                'deskripsi' => 'Maksimal cuti tahunan per karyawan'
            ],
            [
                'kunci_pengaturan' => 'min_pemberitahuan_cuti',
                'nilai_pengaturan' => '3',
                'deskripsi' => 'Minimal hari pemberitahuan sebelum cuti'
            ],
            [
                'kunci_pengaturan' => 'masa_kerja_minimal',
                'nilai_pengaturan' => '1',
                'deskripsi' => 'Masa kerja minimal untuk cuti tahunan (tahun)'
            ],
            [
                'kunci_pengaturan' => 'email_admin',
                'nilai_pengaturan' => 'admin@perusahaan.com',
                'deskripsi' => 'Email administrator sistem'
            ]
        ];

        foreach ($pengaturans as $pengaturan) {
            PengaturanSistem::create($pengaturan);
        }
    }
}