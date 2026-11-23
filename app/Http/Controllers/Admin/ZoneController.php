<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
   // Menampilkan daftar seluruh data zona
    public function index()
    {
        $zones = Zone::all();
        return view('Admin.pages.zona.zona', compact('zones'));
    }

    // Menampilkan form tambah zona
    public function create()
    {
        return view('Admin.pages.zona.tambah');
    }

    // Menyimpan zona baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_zona' => 'required|string|max:255',
            'deskripsi_wilayah' => 'nullable|string',
        ]);

        Zone::create([
            'nama_zona' => $request->nama_zona,
            'deskripsi_wilayah' => $request->deskripsi_wilayah,
        ]);

        return redirect()->route('zona.index')->with('success', 'Zona wilayah berhasil ditambahkan!');
    }

    // Menampilkan form edit zona
    public function edit($id)
    {
        $zona = Zone::where('id_zona', $id)->firstOrFail();
        return view('Admin.pages.zona.update', compact('zona'));
    }

    // Memperbarui data zona di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_zona' => 'required|string|max:255',
            'deskripsi_wilayah' => 'nullable|string',
        ]);

        $zona = Zone::where('id_zona', $id)->firstOrFail();
        $zona->update([
            'nama_zona' => $request->nama_zona,
            'deskripsi_wilayah' => $request->deskripsi_wilayah,
        ]);

        return redirect()->route('zona.index')->with('success', 'Zona wilayah berhasil diperbarui!');
    }

    // Menghapus zona dari database
    public function destroy($id)
    {
        $zona = Zone::where('id_zona', $id)->firstOrFail();
        $zona->delete();

        return redirect()->route('zona.index')->with('success', 'Zona wilayah berhasil dihapus!');
    }
}
