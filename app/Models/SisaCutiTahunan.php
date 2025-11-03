<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisaCutiTahunan extends Model
{
    use HasFactory;

    protected $table = 'sisa_cuti_tahunans';
    
    protected $fillable = [
        'id_karyawan',
        'tahun',
        'sisa_cuti'
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}