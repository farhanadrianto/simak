@extends('layouts.admin')

@section('content')

<div style="max-width:700px;margin:auto;">

    <h2 style="margin-bottom:20px;">Edit Pengumuman</h2>

    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $pengumuman->judul }}" required
            style="width:100%;padding:10px;background:#1f2937;color:white;border:none;border-radius:6px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Isi</label>
            <textarea name="isi" required
            style="width:100%;padding:10px;height:120px;background:#1f2937;color:white;border:none;border-radius:6px;">{{ $pengumuman->isi }}</textarea>
        </div>

        <div style="margin-bottom:20px;">
            <label>Tanggal</label>
            <input type="datetime-local" name="tanggal"
            value="{{ date('Y-m-d\TH:i', strtotime($pengumuman->tanggal)) }}"
            style="width:100%;padding:10px;background:#1f2937;color:white;border:none;border-radius:6px;">
        </div>

        <button style="background:#22c55e;color:white;padding:10px 20px;border:none;border-radius:6px;">
            Update
        </button>

        <a href="/admin/pengumuman" style="margin-left:10px;color:#aaa;">Kembali</a>

    </form>

</div>

@endsection