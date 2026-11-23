<?php

namespace Database\Seeders;

use App\Models\ReportAssignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        ReportAssignment::create([
            'id_laporan' => 1,
            'id_petugas' => 2, // Ujang Petugas
            'id_admin' => 1,   // Bapak Admin Dinas
            'waktu_ditugaskan' => now(),
            'catatan_admin' => 'Segera diangkut hari ini.',
            'estimasi_selesai' => now()->addDays(1),
        ]);
    }
}
