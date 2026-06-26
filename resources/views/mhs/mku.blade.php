@extends('layouts.mhs')

@section('content')

<style>
    /* ===== TITLES ===== */
    .section-title {
        color: #059669; /* Hijau Emerald Segar */
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    /* ===== SKS CARD (SOFT LIGHT THEME) ===== */
    .sks-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }
    
    .sks-info-text h4 {
        margin: 0;
        color: #0f172a;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .sks-info-text p { 
        margin: 6px 0 0 0; 
        color: #64748b; 
        font-size: 13px; 
        font-weight: 500;
    }

    /* ===== PROGRESS BAR ===== */
    .progress-container {
        width: 160px;
        height: 10px;
        background: #f1f5f9;
        border-radius: 999px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== ALERT CUSTOM ===== */
    .alert-custom {
        background: #ecfdf5;
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #065f46;
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== TABLE CLEAN STYLE ===== */
    .table-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
        margin-bottom: 24px;
    }

    .table-matkul {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    
    .table-matkul th {
        background: #f8fafc;
        padding: 16px 14px;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table-matkul td {
        padding: 16px 14px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 14px;
    }

    .table-matkul tbody tr:last-child td {
        border-bottom: none;
    }

    /* ===== CHECKBOX DESIGN ===== */
    .checkbox-cell { 
        text-align: center; 
    }
    
    .checkbox-cell input { 
        width: 18px; 
        height: 18px; 
        cursor: pointer; 
        accent-color: #10b981;
    }
    
    .checkbox-cell input:disabled { 
        cursor: not-allowed; 
        opacity: 0.5; 
    }
    
    /* ===== BADGES ===== */
    .badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.15);
        display: inline-block;
    }
    
    .badge.penuh { 
        background: #fef2f2; 
        color: #991b1b; 
        border-color: rgba(239, 68, 68, 0.15);
    }

    /* ===== BUTTON ACTIONS ===== */
    .btn-simpan {
        padding: 12px 28px;
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        color: #ffffff;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }
    
    .btn-simpan:hover:not(:disabled) { 
        opacity: 0.95;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
    }

    .btn-simpan:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
</style>

@php
    $maxSks = auth()->user()->semester <= 2 ? 20 : 24;
@endphp

<div class="section-title">Mata Kuliah Umum (MKU)</div>

<div class="sks-card">
    <div class="sks-info-text">
        <h4>📚 SKS Anda: <span id="displaySks">{{ $total_sks_sekarang }}</span>/{{ $maxSks }} SKS</h4>
        <p>Sisa kuota: <span id="displayQuota">{{ $maxSks - $total_sks_sekarang }}</span> SKS</p>
    </div>
    <div class="progress-container">
        <div id="progressBar" class="progress-bar" style="width: {{ ($total_sks_sekarang / $maxSks) * 100 }}%;"></div>
    </div>
</div>

<div class="alert-custom">
    📌 Silakan tentukan pilihan mata kuliah umum (MKU) yang ingin diambil, kemudian tekan tombol Simpan di bawah tabel.
</div>

@if(session('success'))
    <div class="alert-custom" style="border-color: #10b981; background: #ecfdf5; color: #065f46;">
        ✅ {{ session('success') }}
    </div>
@endif

<form action="{{ route('mhs.mku.store') }}" method="POST">
    @csrf
    <div class="table-container">
        <table class="table-matkul">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">NO</th>
                    <th>KODE</th>
                    <th>MATA KULIAH</th>
                    <th>SKS</th>
                    <th>KELAS</th>
                    <th>KAPASITAS</th>
                    <th>HARI</th>
                    <th>JAM JADWAL</th>
                    <th style="text-align: center; width: 80px;">PILIH</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matkul as $i => $row)
                    @php
                        $sudahAmbil = is_array($sudah) && in_array($row->kode_matkul, $sudah);
                        $penuh = $row->jumlah_terisi >= $row->kapasitas;
                    @endphp
                    <tr @if($sudahAmbil) style="opacity: 0.5; background: #f8fafc;" @endif>
                        <td style="text-align: center; color: #94a3b8; font-weight: 500;">{{ $i + 1 }}</td>
                        <td style="font-weight: 600; color: #475569;">{{ $row->kode_matkul }}</td>
                        <td style="font-weight: 600; color: #0f172a;">{{ $row->nama_matkul }}</td>
                        <td><b class="sks-val" style="color: #0f172a;">{{ $row->sks }}</b></td>
                        <td style="font-weight: 500;">{{ $row->kelas }}</td>
                        <td>
                            <span class="badge {{ $penuh ? 'penuh' : '' }}">
                                {{ $row->jumlah_terisi }}/{{ $row->kapasitas }}
                            </span>
                        </td>
                        <td style="font-weight: 500;">{{ $row->hari }}</td>
                        <td style="color: #475569; font-size: 13px;">{{ $row->jam_mulai }} - {{ $row->jam_selesai }}</td>
                        <td class="checkbox-cell">
                            <input type="checkbox"
                                name="kode_matkul[]"
                                class="matkul-cb"
                                value="{{ $row->kode_matkul }}"
                                data-sks="{{ $row->sks }}"
                                data-nama="{{ $row->nama_matkul }}"
                                {{ $sudahAmbil || $penuh ? 'disabled' : '' }}
                                {{ $sudahAmbil ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="text-align: right; margin-bottom: 40px;">
        <button
            type="submit"
            class="btn-simpan"
            id="btnSimpan"
            disabled>
            ✓ Simpan Pilihan
        </button>
    </div>
</form>

<script>
const checkboxes = document.querySelectorAll('.matkul-cb');
const displaySks = document.getElementById('displaySks');
const displayQuota = document.getElementById('displayQuota');
const progressBar = document.getElementById('progressBar');
const btnSimpan = document.getElementById('btnSimpan');

const MAX_SKS = {{ $maxSks }};
const INITIAL_SKS = {{ $total_sks_sekarang }};

function updateLogic() {
    let addedSks = 0;
    const newlyChecked = document.querySelectorAll('.matkul-cb:checked:not([disabled-server])');

    // Tombol simpan hanya aktif jika ada pilihan modifikasi baru
    btnSimpan.disabled = (newlyChecked.length === 0);

    newlyChecked.forEach(cb => {
        addedSks += parseInt(cb.dataset.sks);
    });

    const total = INITIAL_SKS + addedSks;
    const sisa = MAX_SKS - total;

    // Update elemen representasi Widget SKS
    displaySks.innerText = total;
    displayQuota.innerText = sisa;
    progressBar.style.width = (total / MAX_SKS * 100) + "%";

    // ==========================================
    // STAGE 1: RESET OPERATIONAL BARIS JADWAL
    // ==========================================
    checkboxes.forEach(cb => {
        if (!cb.hasAttribute("disabled-server")) {
            cb.disabled = false;
            const row = cb.closest("tr");
            row.style.opacity = "1";
            row.style.background = "none";
            cb.style.cursor = "pointer";
        }
    });

    // ==========================================
    // STAGE 2: FORCE LIMIT BEBAN SKS MAKSIMAL
    // ==========================================
    checkboxes.forEach(cb => {
        if (!cb.hasAttribute("disabled-server") && !cb.checked) {
            const matkulSks = parseInt(cb.dataset.sks);
            if (matkulSks > sisa) {
                cb.disabled = true;
                const row = cb.closest("tr");
                row.style.opacity = "0.45";
                row.style.background = "#f8fafc";
                cb.style.cursor = "not-allowed";
            }
        }
    });

    // ==========================================
    // STAGE 3: VALIDASI KELAS GANDA (1 MATKUL)
    // ==========================================
    const namaDipilih = [];
    checkboxes.forEach(cb => {
        if (cb.checked) {
            namaDipilih.push(cb.dataset.nama);
        }
    });

    checkboxes.forEach(cb => {
        if (cb.hasAttribute("disabled-server")) return;

        if (!cb.checked && namaDipilih.includes(cb.dataset.nama)) {
            cb.disabled = true;
            const row = cb.closest("tr");
            row.style.opacity = "0.45";
            row.style.background = "#f8fafc";
            cb.style.cursor = "not-allowed";
        }
    });
}

// ==========================================
// INITIALIZER SETUP ON LOAD
// ==========================================
checkboxes.forEach(cb => {
    if (cb.disabled) {
        cb.setAttribute("disabled-server", "true");
    }
    cb.addEventListener("change", updateLogic);
});

// Run logic execution pertama kali halaman dirender
updateLogic();
</script>
@endsection