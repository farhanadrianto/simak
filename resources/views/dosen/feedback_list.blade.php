@extends('layouts.dosen')

@section('content')

<style>
    /* ===== CONTAINER WRAPPER ===== */
    .container {
        max-width: 1200px;
        margin: auto;
        padding-bottom: 60px;
    }

    /* ===== PANEL CARD ===== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
    }

    .card h2 {
        color: #0f172a;
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 25px 0;
    }

    /* ===== MINIMALIST TABLE SYSTEM ===== */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    th {
        padding: 16px 12px;
        color: #1e40af; /* Biru Royal Dosen */
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #cbd5e1;
        background: #f8fafc;
    }

    td {
        padding: 16px 12px;
        color: #334155;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9;
        white-space: normal;
        word-break: break-word;
    }

    tr:hover td {
        background: #f8fafc;
    }

    /* ===== SOFT PASTEL CATEGORY BADGES ===== */
    .badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
    }

    .badge.dosen {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid rgba(29, 78, 216, 0.15);
    }

    .badge.pengajaran {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid rgba(21, 128, 61, 0.15);
    }

    .badge.fasilitas {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid rgba(180, 83, 9, 0.15);
    }

    /* ===== RATING COMPONENT ===== */
    .rating {
        background: #f1f5f9;
        color: #334155;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        display: inline-block;
        white-space: nowrap;
    }

    /* ===== BACK BUTTON (BOTTOM POSITION) ===== */
    .action-row {
        display: flex;
        justify-content: flex-start;
        margin-top: 10px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: #ffffff;
        color: #475569;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(148, 163, 184, 0.02);
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: #1e40af;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }
</style>

<div class="container">

    <!-- DAFTAR FEEDBACK CARD -->
    <div class="card">
        <h2>{{ $title }}</h2>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 120px;">NPM</th>
                        <th style="width: 140px;">Kategori</th>
                        <th style="width: 130px;">NIP / Tujuan</th>
                        <th style="width: 100px;">Rating</th>
                        <th>Isi Komentar / Feedback</th>
                        <th style="width: 180px;">Waktu Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedback as $i => $f)
                    <tr>
                        <td style="font-weight: 600; color: #64748b;">{{ $i + 1 }}</td>
                        <td style="font-family: monospace; font-size: 14px; font-weight: 600;">{{ $f->npm }}</td>
                        <td>
                            <span class="badge {{ $f->kategori }}">
                                {{ ucfirst($f->kategori) }}
                            </span>
                        </td>
                        <td style="font-family: monospace; color: #475569;">{{ $f->nip ?? '-' }}</td>
                        <td>
                            <span class="rating">
                                ⭐ {{ $f->rating }}/5
                            </span>
                        </td>
                        <td style="line-height: 1.5; font-weight: 500;">{{ $f->isi }}</td>
                        <td style="color: #64748b; font-size: 13px; font-weight: 500;">
                            {{ \Carbon\Carbon::parse($f->tanggal)->locale('id')->translatedFormat('d F Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px 0; color: #94a3b8; font-weight: 500;">
                            📭 Belum ada data laporan feedback yang masuk pada kategori ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- TOMBOL KEMBALI DI BAGIAN BAWAH -->
    <div class="action-row">
        <a href="{{ route('dosen.feedback') }}" class="btn-back">
            <span>←</span> Kembali
        </a>
    </div>

</div>

@endsection