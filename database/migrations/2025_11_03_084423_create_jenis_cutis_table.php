<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cuti', 10);
            $table->string('nama_cuti', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('maksimal_hari')->nullable();
            $table->boolean('is_dibayar')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_cutis');
    }
};