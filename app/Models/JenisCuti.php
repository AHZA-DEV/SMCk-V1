<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;

    protected $table = 'jenis_cutis';
    
    protected $fillable = [
        'kode_cuti',
        'nama_cuti',
        'deskripsi',
        'maksimal_hari',
        'is_dibayar'
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'id_jenis_cuti');
    }
}