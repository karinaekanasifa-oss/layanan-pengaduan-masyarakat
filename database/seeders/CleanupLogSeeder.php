<?php

namespace Database\Seeders;

use App\Models\CleanupLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CleanupLogSeeder extends Seeder
{
    public function run(): void
    {
        CleanupLog::create([
            'id_laporan' => 1,
            'id_petugas' => 2, // Ujang Petugas
            'status_perubahan' => 'sedang_dibersihkan',
            'foto_bukti' => null,
            'catatan_petugas' => 'Petugas sedang menuju lokasi.',
            'waktu_pembaruan' => now(),
        ]);
    }
}
