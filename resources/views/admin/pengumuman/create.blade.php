@extends('layouts.admin')

@section('content')

<div style="max-width:700px;margin:auto;">

    <h2 style="margin-bottom:20px;">Tambah Pengumuman</h2>

    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>Judul</label>
            <input type="text" name="judul" required
            style="width:100%;padding:10px;background:#1f2937;color:white;border:none;border-radius:6px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Isi</label>
            <textarea name="isi" required
            style="width:100%;padding:10px;height:120px;background:#1f2937;color:white;border:none;border-radius:6px;"></textarea>
        </div>

        <div style="margin-bottom:20px;">
            <label>Tanggal</label>
            <input type="datetime-local" name="tanggal"
            value="{{ date('Y-m-d\TH:i') }}"
            style="width:100%;padding:10px;background:#1f2937;color:white;border:none;border-radius:6px;">
        </div>

        <button style="background:#3b82f6;color:white;padding:10px 20px;border:none;border-radius:6px;">
            Simpan
        </button>

        <a href="/admin/pengumuman" style="margin-left:10px;color:#aaa;">Kembali</a>

    </form>

</div>

@endsection