<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteReport;
use App\Models\ReportAssignment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReportAssignmentController extends Controller
{
    // 1. Menampilkan daftar seluruh laporan masuk dari masyarakat
    public function indexLaporan()
    {
        $waste_reports = WasteReport::with(['zona', 'pelapor'])->latest('dibuat_pada')->get();
        return view('Admin.pages.laporan.laporan', compact('waste_reports'));
    }

    // 2. Menampilkan detail laporan & foto kondisi awal
    public function showLaporan($id)
    {
        $laporan = WasteReport::with(['zona', 'pelapor'])->where('id_laporan', $id)->firstOrFail();
        return view('Admin.pages.laporan.show', compact('laporan'));
    }

    // 3. Menyimpan laporan baru (Jika admin/warga menginput laporan beserta UPLOAD GAMBAR & SIMLINK)
    public function storeLaporan(Request $request)
    {
        $request->validate([
            'id_zona' => 'required|integer',
            'jenis_sampah' => 'required|in:organik,campuran',
            'lokasi' => 'required|string|max:255',
            'foto_kondisi_awal' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'ulasan_warga' => 'nullable|string',
        ]);

        // Proses penyimpanan gambar menggunakan symlink (disk public)
        $slug = Str::slug($request->lokasi, '-');
        $filename = time() . '-' . $slug . '.' . $request->file('foto_kondisi_awal')->getClientOriginalExtension();

        // Disimpan ke folder storage/app/public/folder-laporan
        $path = $request->file('foto_kondisi_awal')->storeAs('folder-laporan', $filename, 'public');

        WasteReport::create([
            'id_pelapor' => Auth::id() ?? 1,
            'id_zona' => $request->id_zona,
            'jenis_sampah' => $request->jenis_sampah,
            'lokasi' => $request->lokasi,
            'foto_kondisi_awal' => $path, // path tersimpan di database
            'ulasan_warga' => $request->ulasan_warga,
            'status_laporan' => 'dilaporkan',
            'dibuat_pada' => now(),
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    // 4. Menampilkan daftar riwayat penugasan lapangan ke petugas
    public function indexPenugasan()
    {
        // Diubah dari $penugasan menjadi $penugasans agar cocok dengan file Blade
        $penugasans = ReportAssignment::with(['laporan.zona', 'petugas', 'admin'])->get();
        return view('Admin.pages.penugasan.penugasan', compact('penugasans'));
    }

    // 5. Menampilkan form buat penugasan baru
    public function createPenugasan()
    {
        $waste_reports = WasteReport::where('status_laporan', 'dilaporkan')->with('zona')->get();
        $petugas_list = User::where('peran', 'Petugas')->get();
        return view('Admin.pages.penugasan.tambah', compact('waste_reports', 'petugas_list'));
    }

    // 6. Menyimpan data penugasan ke database
    public function storePenugasan(Request $request)
    {
        $request->validate([
            'id_laporan' => 'required|exists:waste_reports,id_laporan',
            'id_petugas' => 'required|exists:users,id_pengguna',
            'estimasi_selesai' => 'required|date',
            'catatan_admin' => 'nullable|string',
        ]);

        ReportAssignment::create([
            'id_laporan' => $request->id_laporan,
            'id_petugas' => $request->id_petugas,
            'id_admin' => Auth::id() ?? 1,
            'waktu_ditugaskan' => now(),
            'catatan_admin' => $request->catatan_admin,
            'estimasi_selesai' => $request->estimasi_selesai,
        ]);

        // Update status laporan menjadi 'ditugaskan'
        $laporan = WasteReport::where('id_laporan', $request->id_laporan)->firstOrFail();
        $laporan->update(['status_laporan' => 'ditugaskan']);

        return redirect()->route('penugasan.index')->with('success', 'Laporan berhasil ditugaskan ke petugas!');
    }

    // 7. Menghapus / membatalkan penugasan
    public function destroyPenugasan($id)
    {
        $penugasan = ReportAssignment::where('id_penugasan', $id)->firstOrFail();

        $laporan = WasteReport::where('id_laporan', $penugasan->id_laporan)->firstOrFail();
        $laporan->update(['status_laporan' => 'dilaporkan']);

        $penugasan->delete();

        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil dibatalkan!');
    }
}
