<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawans';
    
    protected $fillable = [
        'nip',
        'nama_depan',
        'nama_belakang',
        'email',
        'password',
        'id_departemen',
        'jabatan',
        'tanggal_mulai_kerja',
        'no_telepon',
        'alamat',
        'peran',
        'sisa_cuti',
        'foto_profil'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_mulai_kerja' => 'date',
    ];

    // Accessor untuk nama lengkap
    public function getNamaLengkapAttribute()
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }

    // Relationships
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'id_karyawan');
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_karyawan');
    }

    public function sisaCutiTahunan()
    {
        return $this->hasMany(SisaCutiTahunan::class, 'id_karyawan');
    }

    public function persetujuanCuti()
    {
        return $this->hasMany(Cuti::class, 'disetujui_oleh');
    }
}