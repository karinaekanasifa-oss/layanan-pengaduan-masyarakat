<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('waste_reports', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_pelapor');
            $table->unsignedBigInteger('id_zona');
            $table->text('ulasan_warga')->nullable();
            $table->enum('jenis_sampah', ['organik', 'b3', 'campuran']);
            $table->string('lokasi');
            $table->string('foto_kondisi_awal', 255); 
            $table->enum('status_laporan', ['dilaporkan', 'ditugaskan', 'dibersihkan'])->default('dilaporkan');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_pelapor')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->foreign('id_zona')->references('id_zona')->on('zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_reports');
    }
};
