<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function dashboard()
    {
        $user = auth()->user();

        // Grafik Mahasiswa per Kode Prodi
        $mhsPerProdi = DB::table('users')
            ->join('prodi', 'users.kode_prodi', '=', 'prodi.kode_prodi')
            ->select(
                'prodi.nama_prodi',
                DB::raw('COUNT(*) as total')
            )
            ->where('users.role', 'mahasiswa')
            ->groupBy('prodi.nama_prodi')
            ->orderBy('prodi.nama_prodi')
            ->get();

        $totalFeedbackProdi = DB::table('feedback')
            ->join('prodi', 'feedback.kode_prodi', '=', 'prodi.kode_prodi')
            ->select(
                'prodi.nama_prodi',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('prodi.nama_prodi')
            ->orderBy('prodi.nama_prodi')
            ->get();

        return view('admin.dashboard', [
            'user' => $user,
            'mhsPerProdi' => $mhsPerProdi,
            'totalFeedbackProdi' => $totalFeedbackProdi
        ]);
    }

    public function report()
{
    $user = auth()->user();

    $mhsPerProdi = DB::table('users')
        ->join('prodi', 'users.kode_prodi', '=', 'prodi.kode_prodi')
        ->select(
            'prodi.nama_prodi',
            DB::raw('COUNT(*) as total')
        )
        ->where('users.role', 'mahasiswa')
        ->groupBy('prodi.nama_prodi')
        ->orderBy('prodi.nama_prodi')
        ->get();

    $totalFeedbackProdi = DB::table('feedback')
        ->join('prodi', 'feedback.kode_prodi', '=', 'prodi.kode_prodi')
        ->select(
            'prodi.nama_prodi',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('prodi.nama_prodi')
        ->orderBy('prodi.nama_prodi')
        ->get();

    return view('admin.report', compact(
        'user',
        'mhsPerProdi',
        'totalFeedbackProdi'
    ));
}

public function reportMahasiswa()
{
    $mhsPerProdi = DB::table('users')
        ->join('prodi','users.kode_prodi','=','prodi.kode_prodi')
        ->select(
            'prodi.nama_prodi',
            DB::raw('COUNT(*) as total')
        )
        ->where('users.role','mahasiswa')
        ->groupBy('prodi.nama_prodi')
        ->get();

    return view(
        'admin.report_mahasiswa',
        compact('mhsPerProdi')
    );
}

public function reportFeedback()
{
    $totalFeedbackProdi = DB::table('feedback')
        ->join('prodi','feedback.kode_prodi','=','prodi.kode_prodi')
        ->select(
            'prodi.nama_prodi',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('prodi.nama_prodi')
        ->get();

    return view(
        'admin.report_feedback',
        compact('totalFeedbackProdi')
    );
}
public function reportKrs()
{
    $statusKrs = DB::table('krs')
        ->select(
            'status',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('status')
        ->get();

    return view(
        'admin.report_krs',
        compact('statusKrs')
    );
}
}