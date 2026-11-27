<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_assignments', function (Blueprint $table) {
            $table->id('id_penugasan');
            $table->unsignedBigInteger('id_laporan');
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('id_admin');
            $table->timestamp('waktu_ditugaskan')->useCurrent();
            $table->text('catatan_admin')->nullable();
            $table->timestamp('estimasi_selesai')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_laporan')->references('id_laporan')->on('waste_reports')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_pengguna')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_assignments');
    }
};
