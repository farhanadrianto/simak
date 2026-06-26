@extends('layouts.dosen')

@section('content')

<style>
    /* ===== CONTAINER WRAPPER ===== */
    .container {
        max-width: 1100px;
        margin: auto;
        padding-bottom: 40px;
    }

    /* ===== PAGE HEADER ===== */
    .title-section {
        margin-bottom: 30px;
    }

    .title-section h1 {
        color: #0f172a;
        font-size: 32px;
        font-weight: 800;
        margin: 0;
    }

    .title-section h1 span {
        color: #2563eb; /* Aksen Biru Utama Portal Dosen */
    }

    /* ===== MINIMALIST SEARCH BOX ===== */
    .search-container {
        margin-bottom: 25px;
    }

    .search-box {
        width: 100%;
        max-width: 420px;
        padding: 12px 18px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        color: #0f172a;
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(148, 163, 184, 0.02);
    }

    .search-box:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* ===== PANEL CARD & TABLE ===== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        table-layout: fixed; /* Menjaga ukuran lebar kolom tetap konsisten */
    }

    th {
        background: #f8fafc;
        color: #1e40af;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    td {
        padding: 18px 20px;
        color: #334155;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: #f8fafc;
    }

    /* ===== PERBAIKAN UTAMA: CENTER ALIGNMENT FOR ACTION COLUMN ===== */
    .col-action {
        text-align: center !important;
        padding-right: 20px !important;
        padding-left: 20px !important;
    }

    /* ===== SOFT STATUS BADGES ===== */
    .status {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
    }

    .status.menunggu {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid rgba(194, 65, 12, 0.15);
    }

    .status.disetujui {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid rgba(21, 128, 61, 0.15);
    }

    .status.ditolak {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid rgba(185, 28, 28, 0.15);
    }

    /* ===== INTERACTIVE ACTION BUTTON ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #1e40af;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn:hover {
        background: #1e40af;
        color: #ffffff;
        border-color: #1e40af;
        box-shadow: 0 4px 8px rgba(30, 64, 175, 0.1);
    }

    .empty {
        text-align: center;
        padding: 50px 20px;
        color: #64748b;
        font-weight: 500;
    }
</style>

<div class="container">

    <div class="title-section">
        <h1>Persetujuan <span>KRS Mahasiswa</span></h1>
    </div>

    <div class="search-container">
        <input 
            type="text" 
            id="searchInput" 
            class="search-box" 
            placeholder="🔍 Cari berdasarkan NPM mahasiswa..."
            autocomplete="off"
        >
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">NO</th>
                    <th style="width: 25%;">NPM</th>
                    <th style="width: 25%;">TOTAL SKS</th>
                    <th style="width: 25%;">STATUS</th>
                    <th style="width: 17%;" class="col-action">AKSI</th>
                </tr>
            </thead>

            <tbody id="tableBody">
                @forelse($krs as $i => $k)
                <tr>
                    <td style="font-weight: 600; color: #64748b;">{{ $i + 1 }}</td>

                    <td class="npm" style="font-family: monospace; font-size: 15px; font-weight: 700; color: #0f172a;">
                        {{ $k->npm }}
                    </td>

                    <td style="font-weight: 600;">
                        {{ $k->total_sks }} / 24 SKS
                    </td>

                    <td>
                        <span class="status {{ $k->status }}">
                            {{ ucfirst($k->status) }}
                        </span>
                    </td>

                    <td class="col-action">
                        <a href="{{ route('dosen.approve.detail', $k->npm) }}" class="btn">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty">
                        📥 Belum ada dokumen pengajuan KRS dari mahasiswa bimbingan saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const npmCell = row.querySelector('.npm');
            if (!npmCell) return;

            const text = npmCell.innerText.toLowerCase();
            if (text.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection