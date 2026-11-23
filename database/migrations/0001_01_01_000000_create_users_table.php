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
        Schema::create('users', function (Blueprint $table) {
            // Ubah id() yang tadinya bawaan laravel menjadi id_pengguna sesuai ERD
           $table->id('id_pengguna');

            // Kolom tambahan sesuai ERD Pengaduan Sampah
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telepon', 20)->nullable();
            $table->enum('peran', ['Masyarakat', 'Petugas', 'Admin'])->default('Masyarakat');

            // Relasi ke tabel zones (Pastikan tabel zones sudah dibuat di atas migration ini)
            $table->unsignedBigInteger('id_zona')->nullable();
            $table->foreign('id_zona')->references('id_zona')->on('zones')->onDelete('set null');

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
