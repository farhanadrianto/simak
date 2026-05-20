<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatkulController extends Controller
{
    // ======================
    // 🔥 ADMIN SECTION
    // ======================

    public function index(Request $request)
    {
        $query = Matkul::query();
        if ($request->search) {
            $query->where('nama_matkul', 'like', '%' . $request->search . '%');
        }
        $matkuls = $query->get();
        return view('admin.matkul.index', compact('matkuls'));
    }

    public function create() { return view('admin.matkul.create'); }

    public function store(Request $request)
    {
        Matkul::create($request->all());
        return redirect('/admin/matkul');
    }

    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        return view('admin.matkul.edit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {
        $matkul = Matkul::findOrFail($id);
        $matkul->update($request->all());
        return redirect('/admin/matkul');
    }

    public function destroy($id)
    {
        Matkul::findOrFail($id)->delete();
        return redirect('/admin/matkul');
    }

    // ======================
    // 🔥 HELPER (Private Function)
    // ======================
    
    /**
     * Menghitung total SKS yang sudah diambil mahasiswa (MKR + MKU)
     * Status 'ditolak' tidak ikut dihitung.
     */
    private function getTotalSksMahasiswa($npm)
    {
        return DB::table('krs')
            ->join('matkul', 'krs.kode_matkul', '=', 'matkul.kode_matkul')
            ->where('krs.npm', $npm)
            ->where('krs.status', '!=', 'ditolak')
            ->sum('matkul.sks') ?: 0; // Return 0 jika null
    }

    // ======================
    // 🔥 MAHASISWA (MKR - Reguler)
    // ======================

    public function mkr()
    {
        $user = Auth::user();
        
        // Mengambil total SKS untuk Progress Bar di View
        $total_sks_sekarang = $this->getTotalSksMahasiswa($user->npm);

        // Ambil matkul sesuai prodi mahasiswa & hitung kapasitas real-time
        $matkul = Matkul::where('kode_prodi', $user->kode_prodi)
            ->withCount(['krs as jumlah_terisi' => function ($q) {
                $q->where('status', '!=', 'ditolak');
            }])->get();

        // Daftar kode matkul yang sudah ada di KRS user
        $sudah = Krs::where('npm', $user->npm)->pluck('kode_matkul')->toArray();

        return view('mhs.mkr', compact('matkul', 'sudah', 'total_sks_sekarang'));
    }

    public function storeMkr(Request $request)
    {
        $user = Auth::user();
        $pilih = $request->kode_matkul ?? [];
        $count = 0;
        
        foreach ($pilih as $kode) {
            $current_total = $this->getTotalSksMahasiswa($user->npm);
            $matkul = Matkul::where('kode_matkul', $kode)->first();

            if (!$matkul) continue;

            // 1. Cek apakah sudah pernah ambil
            $cek = Krs::where('npm', $user->npm)->where('kode_matkul', $kode)->exists();
            if ($cek) continue;

            // 2. Cek Kapasitas Matkul
            $terisi = Krs::where('kode_matkul', $kode)->where('status', '!=', 'ditolak')->count();
            
            // 3. Cek Batas Maksimal 24 SKS
            if ($terisi < $matkul->kapasitas && ($current_total + $matkul->sks) <= 24) {
                Krs::create([
                    'npm' => $user->npm,
                    'kode_matkul' => $kode,
                    'status' => 'menunggu'
                ]);
                $count++;
            }
        }

        if ($count > 0) {
            return back()->with('success', "Berhasil menambahkan $count mata kuliah reguler.");
        }
        return back()->with('error', 'Gagal menambah matkul. Cek kuota SKS atau kapasitas kelas.');
    }

    // ======================
    // 🔥 MAHASISWA (MKU - Umum)
    // ======================

    public function mku()
    {
        $user = Auth::user();
        
        // Mengambil total SKS untuk Progress Bar di View
        $total_sks_sekarang = $this->getTotalSksMahasiswa($user->npm);

        // Ambil matkul kategori MKU & hitung kapasitas real-time
        $matkul = Matkul::where('jenis', 'MKU')
            ->withCount(['krs as jumlah_terisi' => function ($q) {
                $q->where('status', '!=', 'ditolak');
            }])->get();

        $sudah = Krs::where('npm', $user->npm)->pluck('kode_matkul')->toArray();

        return view('mhs.mku', compact('matkul', 'sudah', 'total_sks_sekarang'));
    }

    public function storeMku(Request $request)
    {
        $user = Auth::user();
        $pilih = $request->kode_matkul ?? [];
        $count = 0;

        foreach ($pilih as $kode) {
            $current_total = $this->getTotalSksMahasiswa($user->npm);
            $matkul = Matkul::where('kode_matkul', $kode)->first();

            if (!$matkul) continue;

            $cek = Krs::where('npm', $user->npm)->where('kode_matkul', $kode)->exists();
            if ($cek) continue;

            $terisi = Krs::where('kode_matkul', $kode)->where('status', '!=', 'ditolak')->count();

            if ($terisi < $matkul->kapasitas && ($current_total + $matkul->sks) <= 24) {
                Krs::create([
                    'npm' => $user->npm,
                    'kode_matkul' => $kode,
                    'status' => 'menunggu'
                ]);
                $count++;
            }
        }

        if ($count > 0) {
            return back()->with('success', "Berhasil menambahkan $count mata kuliah umum.");
        }
        return back()->with('error', 'Gagal menambah matkul. Cek kuota SKS atau kapasitas kelas.');
    }
}