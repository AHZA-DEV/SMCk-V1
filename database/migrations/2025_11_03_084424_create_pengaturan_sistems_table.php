<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengaturan_sistems', function (Blueprint $table) {
            $table->id();
            $table->string('kunci_pengaturan', 100);
            $table->text('nilai_pengaturan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaturan_sistems');
    }
};