<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id('id_zona'); // Sesuai ERD
            $table->string('nama_zona', 100);
            $table->text('deskripsi_wilayah');
            $table->integer('id_laporan')->nullable(); // Sesuai ERD kamu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
