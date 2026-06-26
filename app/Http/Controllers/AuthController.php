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
            'password' => 'required'
        ]);

        $kodeProdi = substr($request->npm, 4, 4);
        $angkatan = 2000 + substr($request->npm, 0, 2);

        $user = User::where('npm', $request->npm)
            ->where('kode_prodi', $kodeProdi)
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

        $angkatan = 2000 + substr($user->npm, 0, 2);
        Profilemhs::firstOrCreate(
            ['npm' => $user->npm],
            [
                'kode_prodi'   => $user->kode_prodi,
                'nama_lengkap' => 'Mahasiswa Baru',
                'angkatan'     => $angkatan,
                'email_kampus' => $user->npm . '@student.kampus.ac.id'
            ]
        );

        return redirect('/mhs/dashboard');
    }



public function loginDosen(Request $request)
{
    // 1. Validasi Input
    $request->validate([
        'nip' => 'required',
        'password' => 'required'
    ]);

    // 2. Ambil kode prodi dari NIP
    // Contoh NIP: 241010001
    // 24 = angkatan
    // 1010 = kode prodi
    // 001 = nomor dosen
    $kodeProdi = substr($request->nip, 2, 4);

    // 3. Cari User berdasarkan NIP, kode prodi, dan role dosen
    $user = User::where('nip', $request->nip)
        ->where('kode_prodi', $kodeProdi)
        ->where('role', 'dosen')
        ->first();

    // 4. Cek apakah user ditemukan
    if (!$user) {
        return back()->with('error', 'Data dosen tidak ditemukan');
    }

    // 5. Cek Password
    if ($request->password !== $user->password) {
        return back()->with('error', 'Password salah');
    }

    // 6. Login
    Auth::login($user);
    $request->session()->regenerate();

    // 7. Auto insert ke profiledosen
    $profile = ProfileDosen::firstOrCreate(
        ['nip' => $user->nip],
        [
            'kode_prodi'   => $user->kode_prodi,
            'nama_lengkap' => 'Dosen',
            'email_kampus' => $user->nip . '@lecturer.kampus.ac.id'
        ]
    );

    if (empty($profile->email_kampus)) {
        $profile->email_kampus = $user->nip . '@lecturer.kampus.ac.id';
        $profile->save();
    }

    // 8. Redirect dashboard
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