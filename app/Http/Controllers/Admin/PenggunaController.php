<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    // Menampilkan daftar seluruh pengguna
    public function index()
    {
        $penggunas = User::where('peran', '!=', 'Admin')->paginate(5);

        // penulisan link pagination
        $penggunas->appends(request()->query());

        return view('Admin.pages.pengguna.pengguna', compact('penggunas'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        $zones = Zone::all();
        return view('Admin.pages.pengguna.tambah', compact('zones'));
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'peran' => 'required|in:Admin,Petugas,Masyarakat',
            'no_telepon' => 'nullable|string|max:15',
            'id_zona' => 'nullable|exists:zones,id_zona',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => $request->peran,
            'no_telepon' => $request->no_telepon,
            'id_zona' => $request->id_zona,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    // Menampilkan detail / show pengguna
    public function show($id)
    {
        $pengguna = User::where('id_pengguna', $id)->firstOrFail();
        return view('Admin.pages.pengguna.show', compact('pengguna'));
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $pengguna = User::where('id_pengguna', $id)->firstOrFail();
        $zones = Zone::all();
        return view('Admin.pages.pengguna.update', compact('pengguna', 'zones'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $pengguna = User::where('id_pengguna', $id)->firstOrFail();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id_pengguna',
            'peran' => 'required|in:Admin,Petugas,Masyarakat',
            'no_telepon' => 'nullable|string|max:15',
            'id_zona' => 'nullable|exists:zones,id_zona',
        ]);

        $dataUpdate = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'peran' => $request->peran,
            'no_telepon' => $request->no_telepon,
            'id_zona' => $request->id_zona,
        ];

        // Jika password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $pengguna->update($dataUpdate);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $pengguna = User::where('id_pengguna', $id)->firstOrFail();
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus!');
    }
}
