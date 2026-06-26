@extends('layouts.dosen')

@section('content')

<style>
    /* Layout Utama */
    .container {
        max-width: 1200px;
        margin: auto;
        min-height: 90vh;
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .title {
        margin-bottom: 35px;
    }

    .title h1 {
        font-size: 40px;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
    }

    .title p {
        color: #9ca3af;
        margin-top: 10px;
        font-size: 18px;
    }

    /* Card & Tabel */
    .card {
        background: #111827; /* Latar belakang body tabel gelap */
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        height: fit-content; /* Biar kalau datanya 1, kotak hitamnya tidak sisa banyak ke bawah */
        border: 1px solid #1f2937;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Warna Header Ungu Gelap Sesuai Gambar */
    th {
        background: #1a162e; /* Deep Purple */
        color: #a78bfa;    /* Lavender/Light Purple */
        padding: 18px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    td {
        padding: 20px 18px;
        border-top: 1px solid #1f2937;
        color: #e5e7eb;
        font-size: 15px;
    }

    /* Status Badges */
    .status {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }
    .menunggu { background: rgba(251, 146, 60, .15); color: #fb923c; }
    .disetujui { background: rgba(74, 222, 128, .15); color: #4ade80; }
    .ditolak { background: rgba(248, 113, 113, .15); color: #f87171; }

    /* Action Buttons */
    .action { display: flex; gap: 10px; }
    .btn {
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }
    .btn-setuju { background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
    .btn-tolak { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
    .btn-reset { background: rgba(59, 130, 246, 0.15); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.3); }
    .btn:hover { opacity: 0.7; }

    /* Section Total SKS (Tema Hijau) */
    .total-box {
        background: rgba(16, 185, 129, 0.03);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 16px;
        padding: 25px;
        margin-top: auto; /* Mendorong section ini ke paling bawah container */
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-info h3 {
        color: #10b981; /* Judul Hijau */
        font-size: 18px;
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .total-info p {
        color: #9ca3af;
        margin: 0;
        font-size: 14px;
    }

    /* Progress Bar */
    .progress-container {
        width: 40%;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .progress-bg {
        flex-grow: 1;
        height: 10px;
        background: #1f2937;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #10b981; /* Warna Hijau Emerald */
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .percent-text {
        color: #9ca3af;
        font-size: 14px;
        font-weight: 600;
        min-width: 35px;
    }

    /* Tombol Kembali (Hijau) */
.btn-back {
    background: #334155; /* abu2 gelap */
    color: #e2e8f0;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: 0.2s;
}

.btn-back:hover {
    background: #475569;
    transform: translateX(-5px);
}
</style>

<div class="container">
    
    <div class="title">
        <h1>Detail KRS Mahasiswa</h1>
        <p>NPM Mahasiswa: <strong>{{ $npm }}</strong></p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>MATA KULIAH</th>
                    <th>SKS</th>
                    <th>HARI</th>
                    <th>JAM</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
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
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->kode_matkul }}</td>
                    <td>{{ $k->nama_matkul }}</td>
                    <td>{{ $k->sks }}</td>
                    <td>{{ $k->hari }}</td>
                    <td>{{ $k->jam_mulai }} - {{ $k->jam_selesai }}</td>
<td>

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
                    <td>
                        <div class="action">
                            @if($k->status == 'menunggu')
                                <form action="{{ route('dosen.krs.setujui', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-setuju" title="Setujui">✓</button>
                                </form>
                                <form action="{{ route('dosen.krs.tolak', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-tolak" title="Tolak">✕</button>
                                </form>
                            @else
                                <form action="{{ route('dosen.krs.reset', $k->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-reset" title="Reset Status">↺</button>
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
            <p>Total SKS Diambil: <strong>{{ $totalSks }} / 24</strong></p>
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
            ← Kembali
        </a>
    </div>

</div>

@endsection