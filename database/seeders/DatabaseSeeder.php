<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil semua seeder secara berurutan sesuai relasi database
        $this->call([
            ZoneSeeder::class,              //  Induk: Wilayah/Zona
            UserSeeder::class,              //  Induk: Pengguna (Admin, Petugas, Warga)
            WasteReportSeeder::class,       //  Anak: Laporan Sampah (butuh Zona & User)
            ReportAssignmentSeeder::class,  //  Cucu: Penugasan Laporan (butuh Laporan & User)
            CleanupLogSeeder::class,        //  Cucu: Log Pembersihan (butuh Laporan & User)
        ]);
    }
}
