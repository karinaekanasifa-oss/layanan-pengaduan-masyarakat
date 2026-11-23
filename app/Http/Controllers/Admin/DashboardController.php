<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteReport;
use App\Models\Zone;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkasan untuk statistik di dashboard admin
        $totalLaporan = WasteReport::count();
        $totalZona = Zone::count();
        $totalPengguna = User::count();
        $laporanTerbaru = WasteReport::with(['zona', 'pelapor'])->latest('dibuat_pada')->take(5)->get();

        return view('Admin.dashboard', compact('totalLaporan', 'totalZona', 'totalPengguna', 'laporanTerbaru'));
    }
}
