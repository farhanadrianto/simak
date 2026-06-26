@extends('layouts.dosen')

@section('content')

<style>
    /* ===== LAYOUT UTAMA ===== */
    .container {
        max-width: 1200px;
        margin: auto;
        min-height: 90vh;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .title-section {
        margin-bottom: 35px;
    }

    .title-section h1 {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .title-section p {
        color: #64748b;
        margin-top: 8px;
        font-size: 16px;
        font-weight: 500;
    }

    /* ===== PANEL CARD & MINIMALIST TABLE ===== */
    .card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        height: fit-content;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th {
        background: #f8fafc;
        color: #1e40af; /* Biru Royal Dosen */
        padding: 18px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    td {
        padding: 18px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: #f8fafc;
    }

    /* ===== STATUS BADGES ===== */
    .status {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
    }
    .status.menunggu { background: #fff7ed; color: #c2410c; border: 1px solid rgba(194, 65, 12, 0.15); }
    .status.disetujui { background: #f0fdf4; color: #15803d; border: 1px solid rgba(21, 128, 61, 0.15); }
    .status.ditolak { background: #fef2f2; color: #b91c1c; border: 1px solid rgba(185, 28, 28, 0.15); }

    /* ===== ACTIONS TIMING & ALIGNMENT ===== */
    .col-center {
        text-align: center !important;
    }

    .action-container {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .action-container form {
        margin: 0;
        display: inline-block;
    }

    /* ===== ACTION BUTTONS ===== */
    .btn-action {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .btn-setuju { background: #e6f4ea; color: #137333; border: 1px solid rgba(19, 115, 51, 0.2); }
    .btn-setuju:hover { background: #137333; color: #ffffff; }

    .btn-tolak { background: #fce8e6; color: #c5221f; border: 1px solid rgba(197, 34, 31, 0.2); }
    .btn-tolak:hover { background: #c5221f; color: #ffffff; }

    .btn-reset { background: #e8f0fe; color: #1a73e8; border: 1px solid rgba(26, 115, 232, 0.2); }
    .btn-reset:hover { background: #1a73e8; color: #ffffff; }

    /* ===== TOTAL SUMMARY BOX (SOFT GREEN) ===== */
    .total-box {
        background: #f0fdf4;
        border: 1px solid rgba(21, 128, 61, 0.15);
        border-radius: 16px;
        padding: 22px 25px;
        margin-top: auto;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-info h3 {
        color: #15803d;
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .total-info p {
        color: #475569;
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    /* Progress Bar */
    .progress-container {
        width: 45%;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .progress-bg {
        flex-grow: 1;
        height: 10px;
        background: #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #16a34a;
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .percent-text {
        color: #334155;
        font-size: 14px;
        font-weight: 700;
        min-width: 40px;
        text-align: right;
    }

    /* ===== BOTTOM BACK BUTTON ===== */
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
    
    <div class="title-section">
        <h1>Detail KRS Mahasiswa</h1>
        <p>NPM Mahasiswa: <span style="font-family: monospace; font-weight: 700; color: #1e40af;">{{ $npm }}</span></p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th style="width: 6%;">NO</th>
                    <th style="width: 12%;">KODE</th>
                    <th style="width: 32%;">MATA KULIAH</th>
                    <th style="width: 8%;">SKS</th>
                    <th style="width: 10%;">HARI</th>
                    <th style="width: 14%;">JAM</th>
                    <th style="width: 18%;" class="col-center">STATUS</th>
                    <th style="width: 12%;" class="col-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($krs as $i => $k)

                @php
                $bentrok = false;

                foreach ($krs as $j => $cek) {
                    if (
                        $i != $j &&
                        $k->hari == $cek->hari &&
                        $k->jam_mulai < $cek->jam_selesai &&
                        $k->jam_selesai > $cek->jam_mulai
                    ) {
                        $bentrok = true;
                        break;
                    }
                }
                @endphp
                
                <tr>
                    <td style="font-weight: 600; color: #64748b;">{{ $i + 1 }}</td>
                    <td style="font-family: monospace; font-weight: 600; color: #475569;">{{ $k->kode_matkul }}</td>
                    <td style="font-weight: 700; color: #0f172a;">{{ $k->nama_matkul }}</td>
                    <td style="font-weight: 600;">{{ $k->sks }}</td>
                    <td>{{ $k->hari }}</td>
                    <td style="font-variant-numeric: tabular-nums;">{{ $k->jam_mulai }} - {{ $k->jam_selesai }}</td>
                    
                    <td class="col-center">
                        @if($bentrok)
                            <span class="status ditolak">
                                ⚠️ Bentrok Jadwal
                            </span>
                        @else
                            <span class="status {{ $k->status }}">
                                {{ ucfirst($k->status) }}
                            </span>
                        @endif
                    </td>

                    <td class="col-center">
                        <div class="action-container">
                            @if($k->status == 'menunggu')
                                <form action="{{ route('dosen.krs.setujui', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-action btn-setuju" title="Setujui">✓</button>
                                </form>
                                <form action="{{ route('dosen.krs.tolak', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-action btn-tolak" title="Tolak">✕</button>
                                </form>
                            @else
                                <form action="{{ route('dosen.krs.reset', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-action btn-reset" title="Reset Status">↺</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $percentage = ($totalSks / 24) * 100;
    @endphp

    <div class="total-box">
        <div class="total-info">
            <h3>📊 Total SKS</h3>
            <p>Beban Kredit Sementara: <strong style="color: #16a34a; font-size: 15px;">{{ $totalSks }} / 24 SKS</strong></p>
        </div>
        
        <div class="progress-container">
            <div class="progress-bg">
                <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
            </div>
            <span class="percent-text">{{ round($percentage) }}%</span>
        </div>
    </div>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('dosen.approve') }}" class="btn-back">
            <span>←</span> Kembali
        </a>
    </div>

</div>

@endsection