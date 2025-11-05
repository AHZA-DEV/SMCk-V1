<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'karyawans';

    protected $fillable = [
        'nip',
        'nama',
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
    
    // Accessor untuk nama (untuk kompatibilitas)
    public function getNamaAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return $this->nama_depan . ' ' . $this->nama_belakang;
    }

    // Relationships
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_karyawan');
    }

    public function sisaCutiTahunan()
    {
        return $this->hasMany(SisaCutiTahunan::class, 'karyawan_id');
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_karyawan');
    }

    public function persetujuanCuti()
    {
        return $this->hasMany(Cuti::class, 'disetujui_oleh');
    }
}