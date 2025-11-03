<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sisa_cuti_tahunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawan')->constrained('karyawans');
            $table->year('tahun');
            $table->integer('sisa_cuti');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sisa_cuti_tahunans');
    }
};