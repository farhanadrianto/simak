<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Matkul;
use App\Models\Pengumuman;
use App\Models\Feedback;
use App\Models\ProfileDosen;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $user = auth()->user();

        // ===============================
        // Ringkasan Database
        // ===============================

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        $totalDosen = ProfileDosen::count();

        $totalMatkul = Matkul::count();

        $totalPengumuman = Pengumuman::count();

        $totalFeedback = Feedback::count();

        // ===============================
        // Grafik Mahasiswa per Prodi
        // ===============================

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

        // ===============================
        // Grafik Feedback per Prodi
        // ===============================

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
            'totalFeedbackProdi' => $totalFeedbackProdi,

            'totalMahasiswa' => $totalMahasiswa,
            'totalDosen' => $totalDosen,
            'totalMatkul' => $totalMatkul,
            'totalPengumuman' => $totalPengumuman,
            'totalFeedback' => $totalFeedback,
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
            ->join('prodi', 'users.kode_prodi', '=', 'prodi.kode_prodi')
            ->select(
                'prodi.nama_prodi',
                DB::raw('COUNT(*) as total')
            )
            ->where('users.role', 'mahasiswa')
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
            ->join('prodi', 'feedback.kode_prodi', '=', 'prodi.kode_prodi')
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

    public function paketSemester()
    {
        $data = DB::table('paket_semester')
            ->join('matkul', 'paket_semester.kode_matkul', '=', 'matkul.kode_matkul')
            ->select(
                'paket_semester.*',
                'matkul.nama_matkul',
                'matkul.sks',
                'matkul.jenis'
            )
            ->orderBy('semester')
            ->get();

        return view('admin.paket_semester', compact('data'));
    }
}