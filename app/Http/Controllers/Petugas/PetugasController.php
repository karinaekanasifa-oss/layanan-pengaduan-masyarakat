<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportAssignment;
use App\Models\CleanupLog;
use App\Models\WasteReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    // 1. Halaman Dashboard Petugas
    public function index()
    {
        // Ambil ID petugas yang sedang login
        $petugasId = Auth::id() ?? 2;

        // Hitung statistik tugas berdasarkan status laporan ('ditugaskan', 'dibersihkan')
        $tugasBaru = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'ditugaskan');
            })->count();

        $sedangDibersihkan = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'dibersihkan');
            })->count();

        $selesai = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'dibersihkan');
            })->count();

        // Ambil daftar tugas terbaru
        $recentTasks = ReportAssignment::with(['laporan', 'laporan.zona', 'laporan.pelapor'])
            ->where('id_petugas', $petugasId)
            ->latest()
            ->take(5)
            ->get();

        return view('Petugas.dashboard', compact('tugasBaru', 'sedangDibersihkan', 'selesai', 'recentTasks'));
    }

    // 2. Halaman Daftar Tugas Lapangan Saya
    public function penugasan(Request $request)
    {
        $petugasId = Auth::id() ?? 2;

        $query = ReportAssignment::with(['laporan.zona', 'laporan.cleanupLogs' => function($q) {
            $q->latest('waktu_pembaruan');
        }])->where('id_petugas', $petugasId);

        // Filter berdasarkan pilihan triwulan (Q1 - Q4)
        if ($request->filled('filter_triwulan')) {
            switch ($request->filter_triwulan) {
                case 'Q1': // Januari - Maret
                    $query->whereHas('laporan', function($q) {
                        $q->whereMonth('dibuat_pada', '>=', 1)
                          ->whereMonth('dibuat_pada', '<=', 3);
                    });
                    break;
                case 'Q2': // April - Juni
                    $query->whereHas('laporan', function($q) {
                        $q->whereMonth('dibuat_pada', '>=', 4)
                          ->whereMonth('dibuat_pada', '<=', 6);
                    });
                    break;
                case 'Q3': // Juli - September
                    $query->whereHas('laporan', function($q) {
                        $q->whereMonth('dibuat_pada', '>=', 7)
                          ->whereMonth('dibuat_pada', '<=', 9);
                    });
                    break;
                case 'Q4': // Oktober - Desember
                    $query->whereHas('laporan', function($q) {
                        $q->whereMonth('dibuat_pada', '>=', 10)
                          ->whereMonth('dibuat_pada', '<=', 12);
                    });
                    break;
            }
        }

        $penugasans = $query->get();

        return view('Petugas.pages.penugasan.penugasan', compact('penugasans'));
    }

   // 3. Halaman Detail & Form Update Progres Penugasan
    public function detailPenugasan($id)
    {
        // Ambil data penugasan beserta riwayat log pembersihannya
        $penugasan = ReportAssignment::with([
            'laporan.pelapor',
            'laporan.zona',
            'laporan.cleanupLogs' => function($q) {
                $q->latest('waktu_pembaruan');
            }
        ])->findOrFail($id);

        return view('Petugas.pages.penugasan.detail', compact('penugasan'));
    }

   // 4. Proses Simpan Update Status & Upload Foto Bukti (Log Pembersihan)
    public function updateProgres(Request $request, $id)
    {
        $request->validate([
            'status_perubahan' => 'required|in:ditugaskan,sedang_dibersihkan,selesai',
            'foto_bukti'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan_petugas'  => 'nullable|string',
        ]);

        $penugasan = ReportAssignment::findOrFail($id);
        $laporan = WasteReport::findOrFail($penugasan->id_laporan);

        $fotoPath = null;
        if ($request->hasFile('foto_bukti')) {
            $fotoPath = $request->file('foto_bukti')->store('bukti-pembersihan', 'public');
        }

        // Simpan riwayat ke tabel log_pembersihan (CleanupLog)
        CleanupLog::create([
            'id_laporan'      => $laporan->id_laporan,
            'id_petugas'      => Auth::id() ?? 2,
            'status_perubahan'=> $request->status_perubahan,
            'foto_bukti'      => $fotoPath,
            'catatan_petugas' => $request->catatan_petugas,
            'waktu_pembaruan' => now(),
        ]);

        // Petakan ke status utama Waste_Reports ('dilaporkan', 'ditugaskan', 'dibersihkan')
        // Jika status perubahan adalah 'selesai', maka status utama laporan menjadi 'dibersihkan'
        $statusUtama = 'ditugaskan';
        if ($request->status_perubahan == 'sedang_dibersihkan') {
            $statusUtama = 'ditugaskan'; // atau tetap ikuti alur
        } elseif ($request->status_perubahan == 'selesai') {
            $statusUtama = 'dibersihkan';
        }

        $laporan->update([
            'status_laporan' => $statusUtama
        ]);

        return redirect()->route('petugas.penugasan')->with('success', 'Progres penanganan berhasil diperbarui!');
    }
}
