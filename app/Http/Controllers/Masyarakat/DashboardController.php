<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\WasteReport;
use App\Models\Zone;

class MasyarakatController extends Controller
{
    // Menampilkan Dashboard Masyarakat
    public function index()
    {
        return view('Masyarakat.dashboard');
    }

    // Menampilkan Form Pengaduan
    public function create()
    {
        $zones = Zone::all();
        return view('Masyarakat.pages.pengaduan', compact('zones'));
    }

    // Menyimpan data pengaduan baru dengan simling storeAs
    public function store(Request $request)
    {
        $request->validate([
            'id_zona' => 'required',
            'lokasi' => 'required|string|max:255',
            'jenis_sampah' => 'required|string',
            'foto_kondisi_awal' => 'required|image|mimes:jpeg,png,jpg',
            'ulasan_warga' => 'nullable|string',
        ]);

        // Proses simpan file dengan slug & simling
        $slug = Str::slug($request->lokasi, '-');
        $filename = $slug . '-' . time() . '.' . $request->file('foto_kondisi_awal')->getClientOriginalExtension();
        $path = $request->file('foto_kondisi_awal')->storeAs('folder-pengaduan', $filename, 'public');

        // Simpan ke database menggunakan WasteReport
        WasteReport::create([
            'id_zona' => $request->id_zona,
            'lokasi' => $request->lokasi,
            'jenis_sampah' => $request->jenis_sampah,
            'foto_kondisi_awal' => $path,
            'ulasan_warga' => $request->ulasan_warga,
            'status_laporan' => 'menunggu',
        ]);

        return redirect()->route('masyarakat.riwayat')->with('success', 'Pengaduan berhasil dikirim!');
    }

    // Menampilkan Halaman Riwayat Pengaduan Saya
    public function riwayat()
    {
        $pengaduans = WasteReport::with('zona')->get();
        return view('Masyarakat.pages.riwayat', compact('pengaduans'));
    }
}
