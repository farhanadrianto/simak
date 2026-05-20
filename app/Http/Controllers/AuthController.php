<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profilemhs; // 🔥 Sudah ditambahkan
use App\Models\ProfileDosen;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login admin
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login_admin');
    }

    /**
     * Proses login ADMIN (nik + password)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('nik', $credentials['nik'])->first();

        if (!$user) {
            return back()->with('error', 'NIK tidak ditemukan');
        }

        if ($credentials['password'] !== $user->password) {
            return back()->with('error', 'Password salah');
        }

        if ($user->role !== 'admin') {
            return back()->with('error', 'Bukan admin');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    /**
     * 🔥 LOGIN MAHASISWA (npm + password + kode_prodi)
     */
    public function loginMhs(Request $request)
    {
        $request->validate([
            'npm' => 'required',
            'password' => 'required',
            'kode_prodi' => 'required'
        ]);

        $user = User::where('npm', $request->npm)
            ->where('kode_prodi', $request->kode_prodi)
            ->where('role', 'mahasiswa')
            ->first();

        if (!$user) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        if ($request->password !== $user->password) {
            return back()->with('error', 'Password salah');
        }

        Auth::login($user);
        $request->session()->regenerate();

        // 🔥 AUTO INSERT KE profilemhs + Angkatan 2024
        Profilemhs::firstOrCreate(
            ['npm' => $user->npm],
            [
                'kode_prodi' => $user->kode_prodi,
                'nama_lengkap' => 'Mahasiswa Baru',
                'angkatan'   => 2024 // 🔥 Tambahan angkatan otomatis
            ]
        );

        return redirect('/mhs/dashboard');
    }



public function loginDosen(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'nip' => 'required',
        'password' => 'required',
        'kode_prodi' => 'required'
    ]);

    // 2. Cari User dengan filter NIP, Kode Prodi, dan Role Dosen
    $user = User::where('nip', $request->nip)
                ->where('kode_prodi', $request->kode_prodi)
                ->where('role', 'dosen') // 🔥 Syarat role harus dosen
                ->first();

    // 3. Cek apakah user ditemukan
    if (!$user) {
        return back()->with('error', 'Data dosen tidak ditemukan atau prodi salah');
    }

    // 4. Cek Password (Manual tanpa bcrypt sesuai permintaan)
    if ($request->password !== $user->password) {
        return back()->with('error', 'Password salah');
    }

    // 5. Login & Regenerate Session (Keamanan)
    Auth::login($user);
    $request->session()->regenerate();

    // 6. 🔥 AUTO INSERT KE profiledosen saat pertama kali login
    // Menggunakan firstOrCreate agar jika data sudah ada, tidak akan double
    ProfileDosen::firstOrCreate(
        ['nip' => $user->nip], // Cek berdasarkan NIP
        [
            'kode_prodi' => $user->kode_prodi,
            'nama_lengkap' => 'Dosen'
            // Tambahkan kolom lain jika diperlukan di sini
        ]
    );

    // 7. Redirect ke Dashboard Dosen
    return redirect('/dosen/dashboard');
}

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}