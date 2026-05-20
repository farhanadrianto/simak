@extends('layouts.mhs')

@section('content')

<style>
/* ===== WRAPPER ===== */
.mhs-container {
    max-width: 1100px;
    margin: auto;
}

/* ===== TITLE ===== */
.section-title {
    color: #34d399;
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
    background:#064e3b;
    color:#34d399;
    padding:4px 10px;
    border-radius:8px;
    font-size:12px;
}

/* ===== PENGUMUMAN ===== */
.pengumuman-card {
    background:#111827;
    border-radius:14px;
    padding:18px 20px;
    margin-bottom:15px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.pengumuman-left {
    display:flex;
    gap:12px;
}

.dot {
    width:10px;
    height:10px;
    background:#34d399;
    border-radius:50%;
    margin-top:7px;
}

.judul {
    font-weight:600;
}

.isi {
    font-size:14px;
    color:#9ca3af;
    margin-top:5px;
}

.tanggal {
    font-size:12px;
    color:#6b7280;
    background:#020617;
    padding:6px 10px;
    border-radius:8px;
}
</style>

<div class="mhs-container">

    {{-- ================= HEADER ================= --}}
    <div style="margin-bottom:25px;">
        <div class="section-title">PORTAL MAHASISWA</div>

<h1 style="font-size:32px; font-weight:700;">
    Halo, <span style="color:#34d399;">{{ $profile->nama_lengkap ?? 'Mahasiswa' }}</span> 👋
</h1>

        <div style="margin-top:8px; color:#9ca3af;">
            Tahun Ajaran 2024 &nbsp;&nbsp; Semester Genap
        </div>
    </div>

    {{-- ================= INFO MAHASISWA ================= --}}
    <div class="section-title">INFORMASI MAHASISWA</div>

    <div class="card">
        <div class="info-row">
            <span>NPM</span>
            <span>{{ auth()->user()->npm }}</span>
        </div>

        <div class="info-row">
            <span>Program Studi</span>
            <span>{{ $prodi->nama_prodi ?? 'Tidak diketahui' }}</span>
        </div>

        <div class="info-row">
            <span>Status</span>
            <span class="badge">Aktif</span>
        </div>
    </div>

    {{-- ================= PENGUMUMAN ================= --}}
    <div class="section-title">📢 PENGUMUMAN</div>

    @forelse($pengumuman as $p)
        <div class="pengumuman-card">

            <div class="pengumuman-left">
                <div class="dot"></div>

                <div>
                    <div class="judul">{{ $p->judul }}</div>
                    <div class="isi">{{ $p->isi }}</div>
                </div>
            </div>

            <div class="tanggal">
                {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y, H:i') }}
            </div>

        </div>
    @empty
        <div class="card" style="text-align:center; color:#9ca3af;">
            Belum ada pengumuman
        </div>
    @endforelse

</div>

@endsection