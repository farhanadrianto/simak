@extends('layouts.dosen')

@section('content')

<style>

.menu-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card{
    background:#111827;
    padding:25px;
    border-radius:14px;
    border:1px solid #1f2937;
}

.card-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:10px;
}

.card-desc{
    color:#94a3b8;
    font-size:14px;
    margin-bottom:15px;
}

.btn{
    display:inline-block;
    padding:10px 16px;
    background:#1e293b;
    color:#cbd5e1;
    text-decoration:none;
    border-radius:8px;
}

</style>

<h1>💬 Feedback Mahasiswa</h1>

<p style="color:#94a3b8;">
    Program Studi: {{ $prodi->nama_prodi ?? '-' }}
</p>

<br>

<div class="menu-grid">

    <div class="card">
        <div class="card-title">👨‍🏫 Feedback Untuk Anda</div>
        <div class="card-desc">
            Feedback kategori dosen untuk NIP Anda
        </div>
        <a href="{{ route('dosen.feedback.saya') }}" class="btn">
            Buka
        </a>
    </div>

    <div class="card">
        <div class="card-title">🏫 Semua Feedback Prodi</div>
        <div class="card-desc">
            Semua feedback mahasiswa pada prodi Anda
        </div>
        <a href="{{ route('dosen.feedback.prodi') }}" class="btn">
            Buka
        </a>
    </div>

    <div class="card">
        <div class="card-title">📖 Pengajaran Untuk Anda</div>
        <div class="card-desc">
            Feedback pengajaran untuk NIP Anda
        </div>
        <a href="{{ route('dosen.feedback.pengajaran') }}" class="btn">
            Buka
        </a>
    </div>

    <div class="card">
        <div class="card-title">🏢 Feedback Fasilitas</div>
        <div class="card-desc">
            Feedback fasilitas dari mahasiswa
        </div>
        <a href="{{ route('dosen.feedback.fasilitas') }}" class="btn">
            Buka
        </a>
    </div>



</div>

@endsection