<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDosen;

class FeedbackController extends Controller
{
    public function index()
    {
        $data = Feedback::where('npm', Auth::user()->npm)
            ->orderBy('tanggal', 'desc')
            ->get();

        $dosen = ProfileDosen::where('kode_prodi', Auth::user()->kode_prodi)
            ->orderBy('nama_lengkap')
            ->get();

        return view('mhs.feedback', compact('data', 'dosen'));
    }

public function store(Request $request)
{
    $request->validate([
        'kategori' => 'required|in:dosen,pengajaran,fasilitas',
        'nip' => 'nullable',
        'rating' => 'required',
        'isi' => 'required',
        'tanggal' => 'required'
    ]);

    Feedback::create([
        'npm' => Auth::user()->npm,
        'kode_prodi' => Auth::user()->kode_prodi,

        'kategori' => $request->kategori,
        'nip' => $request->nip,

        'rating' => $request->rating,
        'isi' => $request->isi,
        'tanggal' => $request->tanggal
    ]);

    return back();
}

    public function delete($id)
    {
        Feedback::where('id', $id)
            ->where('npm', Auth::user()->npm)
            ->delete();

        return back();
    }

public function edit($id)
{
    $data = Feedback::where('id', $id)
        ->where('npm', Auth::user()->npm)
        ->first();

    $dosen = ProfileDosen::where(
        'kode_prodi',
        Auth::user()->kode_prodi
    )
    ->orderBy('nama_lengkap')
    ->get();

    return view(
        'mhs.feedback_edit',
        compact('data','dosen')
    );
}

public function update(Request $request, $id)
{
Feedback::where('id', $id)
    ->where('npm', Auth::user()->npm)
    ->update([

        'kategori' => $request->kategori,

        'nip' =>
            $request->kategori == 'fasilitas'
                ? null
                : $request->nip,

        'rating' => $request->rating,
        'isi' => $request->isi,
        'tanggal' => $request->tanggal

    ]);

    return redirect()->route('mhs.feedback');
}
}