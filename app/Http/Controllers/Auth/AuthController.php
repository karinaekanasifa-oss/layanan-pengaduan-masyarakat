<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login Multi-Role (Masyarakat, Petugas, Admin)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Arahkan sesuai peran (role) di ERD
            if ($user->peran === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->peran === 'Petugas') {
                return redirect()->route('petugas.dashboard');
            }

            // Jika Masyarakat, arahkan ke halaman tujuan sebelumnya (misal form pengaduan) atau ke dashboard
            return redirect()->intended(route('masyarakat.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan Form Register Khusus Masyarakat
    public function showRegister()
    {
        $zones = Zone::all(); // Ambil data zona wilayah jika dibutuhkan saat daftar
        return view('auth.register', compact('zones'));
    }

    // Proses Simpan Akun Baru Masyarakat
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'required|string|max:20',
            'id_zona' => 'nullable|exists:zones,id_zona',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'id_zona' => $request->id_zona,
            'peran' => 'Masyarakat', // Otomatis diset sebagai Masyarakat
            'password' => Hash::make($request->password),
        ]);

        // Otomatis login setelah berhasil mendaftar
        Auth::login($user);

        return redirect()->intended(route('masyarakat.pengaduan'))->with('success', 'Pendaftaran berhasil! Silakan buat laporan pengaduan.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('masyarakat.dashboard');
    }
}
