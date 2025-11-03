<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';
    
    protected $fillable = [
        'id_karyawan',
        'judul',
        'pesan',
        'sudah_dibaca',
        'tautan'
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}