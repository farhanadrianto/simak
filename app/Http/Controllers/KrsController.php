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

        return view('mhs.viewkrs', compact('krs', 'totalSks'));
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
}