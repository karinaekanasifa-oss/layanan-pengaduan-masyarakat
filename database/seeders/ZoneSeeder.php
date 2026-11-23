<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        Zone::insert([
            [
                'nama_zona' => 'Zona A - Kecamatan Sukamaju',
                'deskripsi_wilayah' => 'Wilayah pusat kota dan area komersial.',
                'id_laporan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_zona' => 'Zona B - Kecamatan Sukadamai',
                'deskripsi_wilayah' => 'Wilayah pemukiman padat penduduk.',
                'id_laporan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
