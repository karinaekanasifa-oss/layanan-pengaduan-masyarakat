<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID petugas yang sedang login
        $petugasId = Auth::id() ?? 2;

        // Menghitung statistik tugas 
        $tugasBaru = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'ditugaskan');
            })->count();

        $sedangDibersihkan = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan.cleanupLogs', function($q) {
                $q->where('status_perubahan', 'sedang_dibersihkan')
                  ->whereIn('id_log', function($sub) {
                      $sub->select(\DB::raw('MAX(id_log)'))->from('cleanup_logs')->groupBy('id_laporan');
                  });
            })->count();

        $selesai = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan.cleanupLogs', function($q) {
                $q->where('status_perubahan', 'selesai')
                  ->whereIn('id_log', function($sub) {
                      $sub->select(\DB::raw('MAX(id_log)'))->from('cleanup_logs')->groupBy('id_laporan');
                  });
            })->count();

        // Mengambil daftar tugas penanganan terbaru beserta relasi log-nya
        $recentTasks = ReportAssignment::with(['laporan.zona', 'laporan.pelapor', 'laporan.cleanupLogs' => function($q) {
            $q->latest('waktu_pembaruan');
        }])->where('id_petugas', $petugasId)
          ->latest()
          ->take(5)
          ->get();

        return view('Petugas.dashboard', compact('tugasBaru', 'sedangDibersihkan', 'selesai', 'recentTasks'));
    }
}
