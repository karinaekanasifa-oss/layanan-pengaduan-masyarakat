<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'nama_lengkap' => 'Bapak Admin Dinas',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'no_telepon' => '081234567890',
                'peran' => 'Admin',
                'id_zona' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Ujang Petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('password123'),
                'no_telepon' => '081298765432',
                'peran' => 'Petugas',
                'id_zona' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Siti Warga',
                'email' => 'masyarakat@gmail.com',
                'password' => Hash::make('password123'),
                'no_telepon' => '081345678901',
                'peran' => 'Masyarakat',
                'id_zona' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
