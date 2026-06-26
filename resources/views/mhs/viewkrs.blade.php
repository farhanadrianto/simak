@extends('layouts.mhs')

@section('content')

<style>
    /* ===== SECTION TITLES ===== */
    .section-title {
        color: #059669; /* Hijau Emerald Segar */
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .main-heading {
        color: #0f172a; 
        font-size: 32px; 
        font-weight: 800; 
        margin: 0 0 8px 0;
    }

    .sub-heading {
        color: #64748b; 
        margin: 0 0 30px 0;
        font-size: 15px;
        font-weight: 500;
    }

    /* ===== MAIN WRAPPER ===== */
    .krs-wrapper {
        display: flex;
        flex-direction: column;
        gap: 30px;
        min-height: 80vh; 
        padding-bottom: 100px; 
    }

    /* ===== ALERT SYSTEM ===== */
    .alert-custom {
        background: #ecfdf5;
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #065f46;
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
    }

    /* ===== PACKET BUTTON ===== */
    .btn-paket {
        background: #10b981;
        color: white;
        border: none;
        padding: 12px 22px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }
    .btn-paket:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    /* ===== TABLE CLEAN STYLE ===== */
    .table-wrapper {
        width: 100%;
        overflow-x: auto; 
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }

    .table-krs {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px; 
        text-align: left;
    }

    .table-krs th {
        background: #f8fafc;
        color: #475569;
        padding: 16px 14px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-krs td {
        padding: 16px 14px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
    }

    .table-krs tr:last-child td {
        border-bottom: none;
    }

    .table-krs tr:hover {
        background: #f8fafc;
    }

    /* ===== SOFT STATUS BADGES ===== */
    .badge {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-menunggu {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid rgba(251, 146, 60, 0.2);
    }

    .badge-disetujui {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-ditolak {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* ===== ACTION BUTTON ===== */
    .btn-hapus {
        padding: 6px 14px;
        border-radius: 8px;
        background: #fff5f5;
        color: #e53e3e;
        border: 1px solid rgba(229, 62, 62, 0.15);
        cursor: pointer;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.2s;
    }

    .btn-hapus:hover {
        background: #fed7d7;
        color: #c53030;
    }

    /* ===== SUMMARY FOOTER CARD ===== */
    .summary {
        margin-top: auto; 
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }

    .summary-flex {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        gap: 20px;
        flex-wrap: wrap; 
    }

    .summary h3 {
        color: #0f172a;
        font-size: 16px;
        font-weight: 700;
    }

    .progress-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
        width: 320px; 
        min-width: 220px;
        margin-left: auto; 
    }

    .progress-bar {
        flex: 1;
        height: 10px;
        background: #f1f5f9;
        border-radius: 999px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        border-radius: 999px;
    }

    /* ===== MODAL STYLING (LIGHT MINIMALIST) ===== */
    .modal-delete {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.4); /* Backdrop redup halus */
        backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .modal-box {
        width: 400px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-box h3 {
        margin: 0 0 10px 0;
        color: #1e293b;
        font-size: 18px;
        font-weight: 700;
    }

    .modal-box p {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 24px 0;
        line-height: 1.5;
    }

    .modal-action {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .btn-batal {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-ya {
        background: #ef4444;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.15s;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
    }

    .btn-batal:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .btn-ya:hover {
        background: #dc2626;
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.25);
    }
</style>

<div class="section-title">Ringkasan Rencana</div>
<h1 class="main-heading">Kartu Rencana Studi <span style="color: #10b981;">(KRS)</span></h1>
<p class="sub-heading">Lihat, pantau status persetujuan, dan kelola mata kuliah Anda di sini.</p>

@if(session('success'))
    <div class="alert-custom">
        ✅ {{ session('success') }}
    </div>
@endif

@if(auth()->user()->semester == 2)
    <form action="{{ route('mhs.krs.ambilPaket') }}" method="POST" style="margin-bottom: 24px;">
        @csrf
        <button type="submit" class="btn-paket" onclick="return confirm('Ambil seluruh paket semester?')">
            📦 Ambil Paket Semester 2
        </button>
    </form>
@endif

<div class="krs-wrapper">
    <div class="table-wrapper">
        <table class="table-krs">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">NO</th>
                    <th>KODE</th>
                    <th>MATA KULIAH</th>
                    <th>SKS</th>
                    <th>KELAS</th>
                    <th>HARI</th>
                    <th>JAM JADWAL</th>
                    <th>STATUS</th>
                    <th style="text-align: center; width: 100px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($krs as $i => $row)
                    @php
                        $bentrok = false;
                        foreach ($krs as $j => $cek) {
                            if ($i != $j) {
                                if (
                                    $row->hari == $cek->hari &&
                                    $row->jam_mulai < $cek->jam_selesai &&
                                    $row->jam_selesai > $cek->jam_mulai
                                ) {
                                    $bentrok = true;
                                    break;
                                }
                            }
                        }
                    @endphp
                    <tr>
                        <td style="text-align: center; color: #94a3b8; font-weight: 500;">{{ $i+1 }}</td>
                        <td style="font-weight: 600; color: #475569;">{{ $row->kode_matkul }}</td>
                        <td style="font-weight: 600; color: #0f172a;">{{ $row->nama_matkul }}</td>
                        <td><b style="color: #0f172a;">{{ $row->sks }}</b></td>
                        <td style="font-weight: 500;">{{ $row->kelas }}</td>
                        <td style="font-weight: 500;">{{ $row->hari }}</td>
                        <td style="color: #475569; font-size: 13px;">{{ $row->jam_mulai }} - {{ $row->jam_selesai }}</td>
                        <td>
                            @if($bentrok)
                                <span class="badge badge-ditolak">
                                    ⚠️ Jadwal Bertabrakan
                                </span>
                            @else
                                <span class="badge badge-{{ $row->status }}">
                                    @if($row->status == 'menunggu')
                                        ⏳ Menunggu
                                    @elseif($row->status == 'disetujui')
                                        ✓ Disetujui
                                    @else
                                        ✗ Ditolak
                                    @endif
                                </span>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <form action="{{ route('mhs.krs.delete', $row->id) }}"
                                  method="POST"
                                  style="display: inline;"
                                  class="form-hapus">
                                @csrf
                                @map('DELETE')
                                <button type="submit" class="btn-hapus">
                                    ✕ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="summary">
        <div class="summary-flex">
            <div>
                <h3 style="margin: 0 0 8px 0;">📊 Total Beban SKS</h3>
                <p style="margin: 0; color: #64748b; font-size: 14px; font-weight: 500;">
                    Total SKS diambil: <b style="color: #0f172a; font-weight: 700;">{{ $totalSks }}</b> dari {{ $maxSks }} SKS
                </p>
                <p style="margin: 6px 0 0 0; color: #64748b; font-size: 13px;">
                    Sisa kuota beban semester: <b style="color: #059669; font-weight: 600;">{{ $maxSks - $totalSks }} SKS</b>
                </p>
            </div>

            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill"
                         style="width: {{ min(($totalSks / $maxSks) * 100, 100) }}%">
                    </div>
                </div>
                <span style="color: #475569; font-weight: 700; font-size: 14px;">
                    {{ round(($totalSks / $maxSks) * 100, 1) }}%
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal-delete" id="modalDelete">
    <div class="modal-box">
        <h3>Hapus Mata Kuliah?</h3>
        <p>Tindakan ini akan membatalkan pengambilan mata kuliah terpilih dari rencana studi semester Anda.</p>
        <div class="modal-action">
            <button class="btn-batal" id="btnBatal">Kembali</button>
            <button class="btn-ya" id="btnYa">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
let formDelete = null;

document.querySelectorAll(".form-hapus").forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        formDelete = this;
        document.getElementById("modalDelete").style.display = "flex";
    });
});

document.getElementById("btnBatal").onclick = function() {
    document.getElementById("modalDelete").style.display = "none";
};

document.getElementById("btnYa").onclick = function() {
    if(formDelete) {
        formDelete.submit();
    }
};

// Tutup modal jika user klik di area luar modal box
window.onclick = function(event) {
    const modal = document.getElementById("modalDelete");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
@endsection