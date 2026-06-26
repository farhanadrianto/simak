@extends('layouts.admin')

@section('content')

<style>
    /* --- LIGHT MODE REPORT STYLES --- */
    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        background: #ffffff;
        padding: 24px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: 0.2s;
    }
    .card:hover {
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .card-desc {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .card-link {
        display: inline-block;
        color: #1e3a8a;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .card-link:hover { text-decoration: underline; }
</style>

<div class="report-grid">

    <div class="card">
        <div class="card-title">🎓 Grafik Mahasiswa per Prodi</div>
        <div class="card-desc">Menampilkan jumlah mahasiswa secara keseluruhan berdasarkan program studi.</div>
        <a href="{{ route('admin.report.mahasiswa') }}" class="card-link">Lihat Grafik →</a>
    </div>

    <div class="card">
        <div class="card-title">💬 Grafik Feedback per Prodi</div>
        <div class="card-desc">Menampilkan total feedback yang diberikan mahasiswa berdasarkan program studi.</div>
        <a href="{{ route('admin.report.feedback') }}" class="card-link">Lihat Grafik →</a>
    </div>

    <div class="card">
        <div class="card-title">🥧 Grafik Status KRS</div>
        <div class="card-desc">Menampilkan ringkasan status KRS: Menunggu, Disetujui, dan Ditolak.</div>
        <a href="{{ route('admin.report.krs') }}" class="card-link">Lihat Grafik →</a>
    </div>

</div>

@endsection