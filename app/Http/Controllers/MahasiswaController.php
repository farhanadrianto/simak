<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profilemhs;
use App\Models\Prodi;
use App\Models\Pengumuman;

class MahasiswaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $profile = Profilemhs::where('npm', $user->npm)->first();
        $prodi = Prodi::where('kode_prodi', $user->kode_prodi)->first();
        $pengumuman = Pengumuman::orderBy('tanggal', 'desc')->get();

        return view('mhs.dashboard', compact('profile', 'prodi', 'pengumuman'));
    }
}