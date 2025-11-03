<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $karyawans = [
            [
                'nip' => 'ADM001',
                'nama_depan' => 'Admin',
                'nama_belakang' => 'Sistem',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'id_departemen' => 2,
                'jabatan' => 'Administrator',
                'tanggal_mulai_kerja' => '2020-01-01',
                'peran' => 'admin',
                'sisa_cuti' => 12,
                'foto_profil' => 'default.png'
            ],
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
            ]
        ];

        foreach ($karyawans as $karyawan) {
            Karyawan::create($karyawan);
        }
    }
}