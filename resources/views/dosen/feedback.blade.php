@extends('layouts.dosen')

@section('content')

<style>
    /* ===== PAGE HEADER ===== */
    .page-title {
        color: #0f172a;
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 35px 0;
    }

    /* ===== RESPONSIVE GRID LAYOUT ===== */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
    }

    /* ===== MINIMALIST CARD COMPONENT ===== */
    .card {
        background: #ffffff;
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(148, 163, 184, 0.08);
    }

    .card-title {
        color: #0f172a;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card-desc {
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 25px;
        font-weight: 500;
    }

    /* ===== INTERACTIVE BUTTON ===== */
    .btn {
        display: block;
        text-align: center;
        padding: 11px 16px;
        background: #f1f5f9;
        color: #1e40af; /* Aksen Biru Dosen */
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .btn:hover {
        background: #1e40af;
        color: #ffffff;
        border-color: #1e40af;
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
    }
</style>

<h1 class="page-title">💬 Feedback Mahasiswa</h1>
<p class="page-subtitle">
    Program Studi: <span style="color: #1e40af;">{{ $prodi->nama_prodi ?? '-' }}</span>
</p>

<div class="menu-grid">

    <!-- CARD 1 -->
    <div class="card">
        <div>
            <div class="card-title">👨‍🏫 Kinerja Individu</div>
            <div class="card-desc">
                Evaluasi dan aspirasi spesifik mahasiswa terhadap performa NIP Anda.
            </div>
        </div>
        <a href="{{ route('dosen.feedback.saya') }}" class="btn">
            Buka
        </a>
    </div>

    <!-- CARD 2 -->
    <div class="card">
        <div>
            <div class="card-title">🏫 Agregat Prodi</div>
            <div class="card-desc">
                Akumulasi seluruh laporan feedback mahasiswa di tingkat program studi.
            </div>
        </div>
        <a href="{{ route('dosen.feedback.prodi') }}" class="btn">
            Buka
        </a>
    </div>

    <!-- CARD 3 -->
    <div class="card">
        <div>
            <div class="card-title">📖 Proses Pengajaran</div>
            <div class="card-desc">
                Tinjauan khusus mengenai metodologi serta materi perkuliahan Anda.
            </div>
        </div>
        <a href="{{ route('dosen.feedback.pengajaran') }}" class="btn">
            Buka
        </a>
    </div>

    <!-- CARD 4 -->
    <div class="card">
        <div>
            <div class="card-title">🏢 Sarana & Fasilitas</div>
            <div class="card-desc">
                Laporan feedback umum mengenai ruang kelas, laboratorium, dan fasilitas penunjang.
            </div>
        </div>
        <a href="{{ route('dosen.feedback.fasilitas') }}" class="btn">
            Buka
        </a>
    </div>

</div>

@endsection