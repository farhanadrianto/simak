<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
    {
        $npm = Auth::user()->npm;

        $krs = DB::table('krs as k')
            ->join('matkul as m', 'k.kode_matkul', '=', 'm.kode_matkul')
            ->where('k.npm', $npm)
            ->select(
                'k.id',
                'k.status',
                'm.kode_matkul',
                'm.nama_matkul',
                'm.sks',
                'm.kelas',
                'm.hari',
                'm.jam_mulai',
                'm.jam_selesai'
            )
            ->orderBy('m.kode_matkul')
            ->get();

        $totalSks = $krs
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->sum('sks');

        $maxSks = Auth::user()->semester <= 2 ? 20 : 24;

return view('mhs.viewkrs', compact(
    'krs',
    'totalSks',
    'maxSks'
));
    }

    public function destroy($id)
    {
        $npm = Auth::user()->npm;

        DB::table('krs')
            ->where('id', $id)
            ->where('npm', $npm)
            ->delete();

        return redirect()->route('mhs.krs')->with('success', 'KRS berhasil dihapus');
    }

public function ambilPaket()
{
    $user = Auth::user();

    if ($user->semester != 2) {
    return back()->with('error', 'Fitur Ambil Paket Semester hanya untuk mahasiswa semester 2.');
}

    // Ambil semua matkul semester mahasiswa
$matkulList = DB::table('paket_semester as p')
    ->join('matkul as m', 'p.kode_matkul', '=', 'm.kode_matkul')
    ->where('p.semester', $user->semester)
    ->select('m.*')
    ->orderBy('m.nama_matkul')
    ->get()
    ->groupBy('nama_matkul');

    $jadwalTerpilih = [];

    foreach ($matkulList as $namaMatkul => $kelasList) {

        // Prioritas kelas A, B, C, D, E, F
        $kelasList = $kelasList->sortBy('kelas');

        foreach ($kelasList as $mk) {

            $bentrok = false;

            foreach ($jadwalTerpilih as $jadwal) {

                if (
                    $mk->hari == $jadwal['hari'] &&
                    $mk->jam_mulai < $jadwal['jam_selesai'] &&
                    $mk->jam_selesai > $jadwal['jam_mulai']
                ) {
                    $bentrok = true;
                    break;
                }
            }

            if (!$bentrok) {

                $sudahAda = DB::table('krs')
                    ->where('npm', $user->npm)
                    ->where('kode_matkul', $mk->kode_matkul)
                    ->exists();

                if (!$sudahAda) {

                    DB::table('krs')->insert([
                        'npm' => $user->npm,
                        'kode_matkul' => $mk->kode_matkul,
                        'status' => 'menunggu',
                        'nip' => null
                    ]);
                }

                $jadwalTerpilih[] = [
                    'hari' => $mk->hari,
                    'jam_mulai' => $mk->jam_mulai,
                    'jam_selesai' => $mk->jam_selesai
                ];

                break;
            }
        }
    }

    return back()->with(
        'success',
        'Paket semester berhasil diambil otomatis tanpa jadwal bentrok'
    );
}
}