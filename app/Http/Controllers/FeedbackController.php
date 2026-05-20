<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $data = Feedback::where('npm', Auth::user()->npm)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('mhs.feedback', compact('data'));
    }

    public function store(Request $request)
    {
        Feedback::create([
            'npm' => Auth::user()->npm,
            'kode_prodi' => Auth::user()->kode_prodi,
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

    return view('mhs.feedback_edit', compact('data'));
}

public function update(Request $request, $id)
{
    Feedback::where('id', $id)
        ->where('npm', Auth::user()->npm)
        ->update([
            'rating' => $request->rating,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal
        ]);

    return redirect()->route('mhs.feedback');
}
}