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
    color: #059669; 
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1.5px;
    margin-bottom: 16px;
}

/* ===== CARD (SOFT LIGHT THEME) ===== */
.card {
    background: #ffffff; /* Putih solid di atas background abu-abu terang */
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 30px;
    border: 1px solid #e2e8f0; 
    box-shadow: 0 4px 12px rgba(148, 163, 184, 0.06); /* Efek bayangan halus biar mengambang */
}

/* ===== INFO ROW ===== */
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 16px 4px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 15px;
}

.info-row span:first-child {
    color: #64748b; 
    font-weight: 500;
}

.info-row span:last-child {
    color: #0f172a; 
    font-weight: 600;
}

.info-row:last-child {
    border-bottom: none;
}

/* ===== BADGE STATUS ===== */
.badge {
    background: #e6f4ea; 
    color: #137333; 
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

/* ===== PENGUMUMAN ===== */
.pengumuman-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px 24px;
    margin-bottom: 16px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 12px rgba(148, 163, 184, 0.04);
    transition: all 0.2s ease-in-out;
}

.pengumuman-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(148, 163, 184, 0.1);
    border-color: #cbd5e1;
}

.pengumuman-left {
    display: flex;
    gap: 16px;
}

.dot {
    width: 10px;
    height: 10px;
    background: #10b981;
    border-radius: 50%;
    margin-top: 6px;
    flex-shrink: 0;
    box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
}

.judul {
    font-weight: 700;
    color: #0f172a;
    font-size: 15px;
}

.isi {
    font-size: 14px;
    color: #475569; 
    margin-top: 6px;
    line-height: 1.5;
}

.tanggal {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    background: #f1f5f9; 
    padding: 8px 12px;
    border-radius: 8px;
    white-space: nowrap;
}
</style>

<div class="mhs-container">

    {{-- ================= HEADER ================= --}}
    <div style="margin-bottom: 35px;">
        <div class="section-title">PORTAL MAHASISWA</div>
        <h1 style="font-size: 32px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px;">
            Halo, <span style="color: #059669;">{{ $profile->nama_lengkap ?? 'Mahasiswa Baru' }}</span> 👋
        </h1>
    </div>

    {{-- ================= INFORMASI MAHASISWA ================= --}}
    <div class="section-title">INFORMASI AKADEMIK MAHASISWA</div>

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
            <span>Status Akademik</span>
            <div>
                <span class="badge">Aktif</span>
            </div>
        </div>
    </div>

    {{-- ================= PENGUMUMAN ================= --}}
    <div class="section-title">📢 PENGUMUMAN TERBARU</div>

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
                {{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->translatedFormat('d F Y, H:i') }}
            </div>

        </div>
    @empty
        <div class="card" style="text-align: center; color: #64748b; font-weight: 500;">
            📭 Belum ada pengumuman untuk saat ini.
        </div>
    @endforelse

</div>

@endsection