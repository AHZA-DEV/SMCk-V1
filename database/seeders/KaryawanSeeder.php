<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan HRD
        Karyawan::create([
            'nip' => 'HRD001',
            'nama_depan' => 'Sarah',
            'nama_belakang' => 'Wijaya',
            'email' => 'hrd@gmail.com',
            'password' => Hash::make('password'),
            'id_departemen' => 2,
            'jabatan' => 'HRD Manager',
            'tanggal_mulai_kerja' => '2019-01-15',
            'no_telepon' => '081234567899',
            'alamat' => 'Jl. HR No. 1 Jakarta',
            'peran' => 'hrd',
            'sisa_cuti' => 12,
            'foto_profil' => 'default.png'
        ]);

        // Karyawan biasa
        $karyawans = [
            [
                'nip' => 'KRY001',
                'nama_depan' => 'Budi',
                'nama_belakang' => 'Santoso',
                'email' => 'budi.santoso@perusahaan.com',
                'password' => Hash::make('password'),
                'id_departemen' => 1,
                'jabatan' => 'Programmer',
                'tanggal_mulai_kerja' => '2021-03-15',
                'no_telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10 Jakarta',
                'peran' => 'karyawan',
                'sisa_cuti' => 10,
                'foto_profil' => 'default.png'
            ],
            [
                'nip' => 'KRY002',
                'nama_depan' => 'Siti',
                'nama_belakang' => 'Rahayu',
                'email' => 'siti.rahayu@perusahaan.com',
                'password' => Hash::make('password'),
                'id_departemen' => 2,
                'jabatan' => 'HR Staff',
                'tanggal_mulai_kerja' => '2020-08-20',
                'no_telepon' => '081234567891',
                'alamat' => 'Jl. Sudirman No. 45 Jakarta',
                'peran' => 'karyawan',
                'sisa_cuti' => 8,
                'foto_profil' => 'default.png'
            ],
            [
                'nip' => 'KRY003',
                'nama_depan' => 'Ahmad',
                'nama_belakang' => 'Fauzi',
                'email' => 'ahmad.fauzi@perusahaan.com',
                'password' => Hash::make('password'),
                'id_departemen' => 3,
                'jabatan' => 'Accountant',
                'tanggal_mulai_kerja' => '2019-05-10',
                'no_telepon' => '081234567892',
                'alamat' => 'Jl. Gatot Subroto No. 12 Jakarta',
                'peran' => 'karyawan',
                'sisa_cuti' => 5,
                'foto_profil' => 'default.png'
            ],
            [
                'nip' => 'KRY004',
                'nama_depan' => 'Dewi',
                'nama_belakang' => 'Anggraini',
                'email' => 'dewi.anggraini@perusahaan.com',
                'password' => Hash::make('password'),
                'id_departemen' => 4,
                'jabatan' => 'Marketing Executive',
                'tanggal_mulai_kerja' => '2022-01-25',
                'no_telepon' => '081234567893',
                'alamat' => 'Jl. Thamrin No. 8 Jakarta',
                'peran' => 'karyawan',
                'sisa_cuti' => 12,
                'foto_profil' => 'default.png'
            ],
            [
                'nip' => 'KRY005',
                'nama_depan' => 'Rina',
                'nama_belakang' => 'Kusuma',
                'email' => 'rina.kusuma@perusahaan.com',
                'password' => Hash::make('password'),
                'id_departemen' => 1,
                'jabatan' => 'Designer',
                'tanggal_mulai_kerja' => '2021-06-01',
                'no_telepon' => '081234567894',
                'alamat' => 'Jl. Kuningan No. 15 Jakarta',
                'peran' => 'karyawan',
                'sisa_cuti' => 11,
                'foto_profil' => 'default.png'
            ]
        ];

        foreach ($karyawans as $karyawan) {
            Karyawan::create($karyawan);
        }
    }
}