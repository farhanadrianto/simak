@extends('layouts.dosen')

@section('content')

<style>
/* ===== WRAPPER ===== */
.dosen-container {
    max-width: 1100px;
    margin: auto;
}

/* ===== TITLE ===== */
.section-title {
    color: #a78bfa;
    font-size: 14px;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

/* ===== CARD ===== */
.card {
    background: #111827;
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 25px;
}

/* ===== INFO ROW ===== */
.info-row {
    display:flex;
    justify-content:space-between;
    padding:14px 0;
    border-bottom:1px solid #1f2937;
}

.info-row:last-child {
    border-bottom:none;
}

/* ===== BADGE ===== */
.badge {
    background:#4c1d95;
    color:#c4b5fd;
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
}
</style>

<div class="dosen-container">

{{-- ================= HEADER ================= --}}
<div style="margin-bottom:25px;">
    <div class="section-title">PORTAL DOSEN</div>

    <h1 style="font-size:32px; font-weight:700;">
        Halo, <span style="color:#a78bfa;">
            {{ $profile->nama_lengkap ?? 'Dosen' }}
        </span> 👋
    </h1>

</div>

    {{-- ================= INFO DOSEN ================= --}}
    <div class="section-title">INFORMASI DOSEN</div>

    <div class="card">

        <div class="info-row">
            <span>NIP</span>
            <span>{{ auth()->user()->nip }}</span>
        </div>

        <div class="info-row">
            <span>Program Studi</span>
            <span>{{ $prodi->nama_prodi ?? '-' }}</span>
        </div>

        <div class="info-row">
            <span>Status</span>
            <span class="badge">Aktif</span>
        </div>

    </div>

</div>

@endsection