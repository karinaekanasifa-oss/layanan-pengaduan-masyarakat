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
        // Ambil ID petugas yang sedang login menggunakan id sesuai role nya
        $petugasId = Auth::id() ?? 2;

        // Hitung statistik tugas untuk petugas tersebut
        $tugasBaru = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'ditugaskan');
            })->count();

        $sedangDikerjakan = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'sedang_dibersihkan');
            })->count();

        $selesai = ReportAssignment::where('id_petugas', $petugasId)
            ->whereHas('laporan', function($q) {
                $q->where('status_laporan', 'selesai');
            })->count();

        // Ambil daftar tugas terbaru
        $recentTasks = ReportAssignment::with(['laporan', 'laporan.zona', 'laporan.pelapor'])
            ->where('id_petugas', $petugasId)
            ->latest()
            ->take(5)
            ->get();

        return view('Petugas.dashboard', compact('tugasBaru', 'sedangDikerjakan', 'selesai', 'recentTasks'));
    }

    // 2. Halaman Daftar Tugas Lapangan Saya
    public function penugasan()
    {
        $petugasId = Auth::id() ?? 2;

        // Ambil seluruh tugas penugasan untuk petugas yang login
        $penugasans = ReportAssignment::with(['laporan', 'laporan.zona'])
            ->where('id_petugas', $petugasId)
            ->get();

        return view('Petugas.pages.penugasan.penugasan', compact('penugasans'));
    }

    // 3. Halaman Detail & Form Update Progres Penugasan
    public function detailPenugasan($id)
    {
        // Ambil data penugasan berdasarkan ID
        $penugasan = ReportAssignment::with(['laporan', 'laporan.pelapor', 'laporan.zona'])->findOrFail($id);

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
            // Simpan foto ke folder public/storage/bukti-pembersihan
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

        // Perbarui status utama di tabel laporan sampah (waste_reports)
        $laporan->update([
            'status_laporan' => $request->status_perubahan
        ]);

        return redirect()->route('petugas.penugasan')->with('success', 'Progres penanganan berhasil diperbarui!');
    }
}
