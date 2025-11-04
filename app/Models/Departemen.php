<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_departemen',
        'kode_departemen',
        'deskripsi',
    ];

    /**
     * Relasi ke Karyawan
     * Satu departemen memiliki banyak karyawan
     */
    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'departemen_id');
    }

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'departemen_id');
    }
}
