<?php

namespace Database\Seeders;

use App\Models\WasteReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WasteReportSeeder extends Seeder
{
    public function run(): void
    {
        WasteReport::create([
            'id_pelapor' => 3, // Mengacu ke id_pengguna Siti Warga
            'id_zona' => 1,    // Mengacu ke id_zona Zona A
            'ulasan_warga' => 'Tumpukan sampah liar di pinggir jalan raya.',
            'jenis_sampah' => 'campuran',
            'lokasi' => 'Jl. Merdeka No. 10',
            'foto_kondisi_awal' => 'sampah_awal_1.jpg',
            'status_laporan' => 'dilaporkan',
            'dibuat_pada' => now(),
        ]);
    }
}
