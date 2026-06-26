@extends('layouts.dosen')

@section('content')

<style>
    /* ===== CONTAINER WRAPPER ===== */
    .dosen-container {
        max-width: 1100px;
        margin: auto;
    }

    /* ===== UPPER SECTION TITLES ===== */
    .section-title {
        color: #1e40af; /* Biru Royal Khas Dosen */
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .main-heading {
        color: #0f172a;
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 25px 0;
    }

    /* ===== MINIMALIST PANEL CARD ===== */
    .card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
    }

    /* ===== CLEAN LIST INFO ROW ===== */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #475569;
        font-weight: 600;
        font-size: 14px;
    }

    .info-value {
        color: #0f172a;
        font-weight: 700;
        font-size: 14px;
    }

    /* ===== SOFT STATUS BADGE ===== */
    .badge {
        background: #eff6ff;
        color: #1e40af;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        border: 1px solid rgba(37, 99, 235, 0.15);
        display: inline-block;
    }
</style>

<div class="dosen-container">

    {{-- ================= WELCOME HEADER ================= --}}
    <div>
        <div class="section-title">Beranda Utama</div>
        <h1 class="main-heading">
            Selamat Datang, <span style="color: #2563eb;">{{ $profile->nama_lengkap ?? 'Dosen' }}</span> 👋
        </h1>
    </div>

    {{-- ================= DOSEN DATA PANEL ================= --}}
    <div class="section-title">Informasi Akademik Dosen</div>
    
    <div class="card">
        <div class="info-row">
            <span class="info-label">NIP</span>
            <span class="info-value" style="font-family: monospace; letter-spacing: 0.5px; font-size: 15px;">
                {{ auth()->user()->nip }}
            </span>
        </div>

        <div class="info-row">
            <span class="info-label">Program Studi</span>
            <span class="info-value">{{ $prodi->nama_prodi ?? '-' }}</span>
        </div>

        <div class="info-row">
            <span class="info-label">Status Akademik</span>
            <span><span class="badge">✓ Aktif</span></span>
        </div>
    </div>

</div>

@endsection