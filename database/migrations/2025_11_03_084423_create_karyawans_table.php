<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->foreignId('id_departemen')->nullable()->constrained('departemens');
            $table->string('jabatan', 100)->nullable();
            $table->date('tanggal_mulai_kerja')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->enum('peran', ['admin', 'karyawan'])->default('karyawan');
            $table->integer('sisa_cuti')->default(12);
            $table->string('foto_profil')->default('default.png');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
};