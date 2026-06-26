@extends('layouts.mhs')

@section('content')

<style>
    /* --- CSS DASAR TABEL (DARI LO) --- */
    .table-matkul {
        width: 100%;
        border-collapse: collapse;
        background: #0f172a;
        border-radius: 12px;
        overflow: hidden;
    }
    .table-matkul th {
        background: rgba(16,185,129,0.1);
        padding: 12px;
        text-align: left;
        color: #34d399;
        font-size: 12px;
    }
    .table-matkul td {
        padding: 12px;
        border-bottom: 1px solid #1e293b;
        color: #e2e8f0;
    }
    .checkbox-cell { text-align: center; }
    .checkbox-cell input { width: 18px; height: 18px; cursor: pointer; }
    .checkbox-cell input:disabled { cursor: not-allowed; opacity: 0.5; }
    
    .badge {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 12px;
        background: rgba(16,185,129,0.1);
        color: #34d399;
    }
    .badge.penuh { background: rgba(239,68,68,0.1); color: #fca5a5; }

    .btn-simpan {
        margin-top: 20px;
        padding: 10px 25px;
        background: #34d399;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        color: #0f172a;
        transition: 0.3s;
    }
    .btn-simpan:hover { background: #10b981; transform: translateY(-2px); }

.btn-simpan:disabled{
    background:#475569;
    color:#94a3b8;
    cursor:not-allowed;
    transform:none;
}

    /* --- CSS BARU SESUAI GAMBAR (GLASSMORPHISM) --- */
    .sks-card {
        background: rgba(30, 41, 59, 0.5); /* Semi transparan */
        border: 1px solid rgba(56, 189, 248, 0.2); /* Border biru tipis */
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sks-info-text h4 {
        margin: 0;
        color: #38bdf8; /* Warna biru muda sesuai gambar */
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sks-info-text p {
        margin: 5px 0 0 0;
        color: #94a3b8;
        font-size: 13px;
    }

    /* Progress Bar Kecil di Kanan */
    .progress-container {
        width: 150px;
        height: 8px;
        background: #0f172a;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #38bdf8, #34d399); /* Gradasi Biru ke Hijau */
        transition: width 0.5s ease;
    }

    /* Alert Info sesuai gambar */
    .alert-custom {
        background: rgba(16, 185, 129, 0.05);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #34d399;
        padding: 12px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>

@php
    $maxSks = auth()->user()->semester <= 2 ? 20 : 24;
@endphp

<!-- Card SKS sesuai Gambar -->
<div class="sks-card">
    <div class="sks-info-text">
<h4>
    📚 SKS Anda:
    <span id="displaySks">{{ $total_sks_sekarang }}</span>/{{ $maxSks }} SKS
</h4>

<p>
    Sisa kuota:
    <span id="displayQuota">{{ $maxSks - $total_sks_sekarang }}</span> SKS
</p>
    </div>
    <div class="progress-container">
        <div id="progressBar"
     class="progress-bar"
     style="width: {{ ($total_sks_sekarang / $maxSks) * 100 }}%;">
</div>
    </div>
</div>

<!-- Alert Info sesuai Gambar -->
<div class="alert-custom">
    📌 Pilih matkul yang ingin diambil, kemudian klik tombol Simpan
</div>

@if(session('success'))
    <div class="alert-custom" style="border-color: #34d399; background: rgba(52, 211, 153, 0.1);">
        ✅ {{ session('success') }}
    </div>
@endif

<form action="{{ route('mhs.mku.store') }}" method="POST">
    @csrf

    <table class="table-matkul">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>MATA KULIAH</th>
                <th>SKS</th>
                <th>KELAS</th>
                <th>KAPASITAS</th>
                <th>HARI</th>
                <th>JAM</th>
                <th style="text-align:center;">PILIH</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matkul as $i => $row)
            @php
                $sudahAmbil = is_array($sudah) && in_array($row->kode_matkul, $sudah);
                $penuh = $row->jumlah_terisi >= $row->kapasitas;
            @endphp
<tr
@if($sudahAmbil)
style="opacity:.45;filter:grayscale(.3);background:rgba(255,255,255,.02);"
@endif
>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->kode_matkul }}</td>
                <td>{{ $row->nama_matkul }}</td>
                <td><b class="sks-val">{{ $row->sks }}</b></td>
                <td>{{ $row->kelas }}</td>
                <td>
                    <span class="badge {{ $penuh ? 'penuh' : '' }}">
                        {{ $row->jumlah_terisi }}/{{ $row->kapasitas }}
                    </span>
                </td>
                <td>{{ $row->hari }}</td>
                <td>{{ $row->jam_mulai }} - {{ $row->jam_selesai }}</td>
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

    <div style="text-align: right;">
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

    const newlyChecked = document.querySelectorAll(
        '.matkul-cb:checked:not([disabled-server])'
    );

    btnSimpan.disabled = (newlyChecked.length === 0);

    newlyChecked.forEach(cb => {
        addedSks += parseInt(cb.dataset.sks);
    });

    const total = INITIAL_SKS + addedSks;
    const sisa = MAX_SKS - total;

    // Update widget
    displaySks.innerText = total;
    displayQuota.innerText = sisa;
    progressBar.style.width = (total / MAX_SKS * 100) + "%";

    // ==========================
    // RESET
    // ==========================

    checkboxes.forEach(cb => {

        if (!cb.hasAttribute("disabled-server")) {

            cb.disabled = false;

            const row = cb.closest("tr");
            row.style.opacity = "1";
            row.style.filter = "none";

            cb.style.cursor = "pointer";
        }

    });

    // ==========================
    // BATAS SKS
    // ==========================

    checkboxes.forEach(cb => {

        if (!cb.hasAttribute("disabled-server") && !cb.checked) {

            const matkulSks = parseInt(cb.dataset.sks);

            if (matkulSks > sisa) {

                cb.disabled = true;

                const row = cb.closest("tr");
                row.style.opacity = "0.45";
                row.style.filter = "grayscale(.3)";

                cb.style.cursor = "not-allowed";
            }

        }

    });

    // ==========================
    // HANYA SATU KELAS
    // ==========================

    const namaDipilih = [];

    checkboxes.forEach(cb => {

        if (cb.checked) {
            namaDipilih.push(cb.dataset.nama);
        }

    });

    checkboxes.forEach(cb => {

        if (cb.hasAttribute("disabled-server")) return;

        if (
            !cb.checked &&
            namaDipilih.includes(cb.dataset.nama)
        ) {

            cb.disabled = true;

            const row = cb.closest("tr");
            row.style.opacity = "0.45";
            row.style.filter = "grayscale(.3)";

            cb.style.cursor = "not-allowed";
        }

    });

}

// ==========================
// INISIALISASI
// ==========================

checkboxes.forEach(cb => {

    if (cb.disabled) {
        cb.setAttribute("disabled-server", "true");
    }

    cb.addEventListener("change", updateLogic);

});

updateLogic();

</script>

@endsection