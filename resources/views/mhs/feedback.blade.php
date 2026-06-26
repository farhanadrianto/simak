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

    /* ===== FORM & ITEM CARD (SOFT LIGHT THEME) ===== */
    .form-card, .feedback-item {
        background: #ffffff; /* Mengganti warna gelap ke putih solid */
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }

    .feedback-item {
        padding: 24px;
        margin-bottom: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .feedback-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(148, 163, 184, 0.08);
        border-color: #cbd5e1;
    }

    /* ===== INPUTS & TEXTAREA ===== */
    .input, textarea, select {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #0f172a;
        outline: none;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    /* Style khusus untuk NPM / Readonly */
    .input-readonly {
        background: #f1f5f9 !important; 
        color: #64748b !important;
        cursor: not-allowed; 
        border: 1px solid #e2e8f0;
    }

    .input:focus:not(.input-readonly), textarea:focus, select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
    }

    /* ===== SELECT CUSTOM ROW ===== */
    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M1.5 5l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 45px;
    }

    select option {
        background: #ffffff;
        color: #0f172a;
    }

    /* ===== RATING SYSTEM STYLE ===== */
    .rating-box {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .rating-box label {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        user-select: none;
        font-size: 14px;
        font-weight: 500;
        color: #475569;
    }

    .rating-box input {
        display: none;
    }

    .rating-box label:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .rating-box label:has(input:checked) {
        border-color: #10b981;
        background: #ecfdf5;
        color: #065f46;
        font-weight: 600;
    }

    /* ===== BUTTONS ===== */
    .btn-save {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        color: #ffffff;
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: opacity 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .btn-save:hover {
        opacity: 0.95;
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
    }

    /* ===== ACTION BUTTONS ===== */
    .action-group {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-edit {
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 14px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-edit:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
    }

    .btn-delete {
        color: #dc2626;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 14px;
        background: #fef2f2;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
        border-color: #dc2626;
    }

    /* ===== LABELS ===== */
    .form-label {
        color: #475569;
        font-weight: 600;
        font-size: 14px;
        display: block;
        margin-bottom: 8px;
    }

    /* ===== BADGE CATEGORY ===== */
    .category-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="section-title">Buat Feedback</div>

<!-- FORM CARD -->
<div class="form-card">
    <h3 style="color: #0f172a; font-size: 18px; font-weight: 700; margin-bottom: 24px;">💬 Tambah Feedback Baru</h3>

    <form action="{{ route('mhs.feedback.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 18px;">
            <label class="form-label">NPM</label>
            <input type="text" class="input input-readonly" value="{{ auth()->user()->npm }}" readonly>
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Kategori Feedback</label>
            <select name="kategori" id="kategori" class="input" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="dosen">Dosen</option>
                <option value="pengajaran">Pengajaran</option>
                <option value="fasilitas">Fasilitas</option>
            </select>
        </div>

        <div id="nipBox" style="display:none; margin-bottom:18px;">
            <label class="form-label">NIP Dosen</label>
            <select id="nip" name="nip">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosen as $d)
                    <option value="{{ $d->nip }}">
                        {{ $d->nip }} - {{ $d->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Rating Kepuasan</label>
            <div class="rating-box">
                @for($i=1; $i<=5; $i++)
                    <label>
                        <input type="radio" name="rating" value="{{ $i }}" required>
                        <span>{{ str_repeat('⭐', $i) }} {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Isi Feedback</label>
            <textarea name="isi" rows="4" placeholder="Bagaimana pengalaman Anda selama perkuliahan atau menggunakan fasilitas?" required></textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label class="form-label">Tanggal</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="input" required>
        </div>

        <button type="submit" class="btn-save">Simpan Feedback</button>
    </form>
</div>

<hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 40px 0;">

<div class="section-title">📋 Feedback Anda</div>

<!-- LIST FEEDBACK -->
@foreach($data as $f)
    <div class="feedback-item">
        <div style="display: flex; justify-content: space-between; align-items: start; gap: 20px; flex-wrap: wrap;">
            
            <!-- Konten (Kiri) -->
            <div style="flex: 1; min-width: 280px;">
                <span style="color: #facc15; font-size: 15px;">{{ str_repeat('★', $f->rating) }}{{ str_repeat('☆', 5 - $f->rating) }}</span>
                <span style="color: #64748b; font-size: 13px; font-weight: 600; margin-left: 6px;">({{ $f->rating }}/5)</span>
                
                <div style="margin-top: 12px;">
                    <div style="margin-bottom: 10px;">
                        <span class="category-badge">
                            {{ ucfirst($f->kategori) }}
                        </span>
                    </div>

                    @if($f->nip)
                        <div style="color: #475569; font-size: 14px; margin-bottom: 8px;">
                            <strong>NIP Dosen:</strong> <code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $f->nip }}</code>
                        </div>
                    @endif

                    <p style="color: #334155; margin: 0 0 12px 0; font-size: 15px; line-height: 1.5;">
                        {{ $f->isi }}
                    </p>
                </div>
                <small style="color: #94a3b8; font-weight: 500;">📅 {{ \Carbon\Carbon::parse($f->tanggal)->locale('id')->translatedFormat('d F Y, H:i') }}</small>
            </div>

            <!-- Tombol Aksi (Kanan) -->
            <div class="action-group">
                <a href="{{ route('mhs.feedback.edit', $f->id) }}" class="btn-edit">
                    ✏️ Edit
                </a>
                <a href="{{ route('mhs.feedback.delete', $f->id) }}" class="btn-delete btn-delete-feedback">
                    🗑️ Hapus
                </a>
            </div>

        </div>
    </div>
@endforeach

<!-- MODAL HAPUS (LIGHT THEME) -->
<div id="modalDelete" style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(4px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
">
    <div style="
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        width: 380px;
        border: 1px solid #e2e8f0;
        text-align: center;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    ">
        <h3 style="color: #0f172a; margin-bottom: 12px; font-size: 18px; font-weight: 700;">Hapus Feedback</h3>
        <p style="color: #64748b; font-size: 14px; line-height: 1.5;">
            Apakah Anda yakin ingin menghapus feedback ini? Tindakan ini tidak dapat dibatalkan.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center; margin-top: 24px;">
            <button id="btnBatal" style="
                padding: 10px 20px;
                background: #f1f5f9;
                border: 1px solid #cbd5e1;
                border-radius: 8px;
                color: #475569;
                font-weight: 600;
                cursor: pointer;
            ">Batal</button>

            <button id="btnYa" style="
                padding: 10px 20px;
                background: #dc2626;
                border: none;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                cursor: pointer;
            ">Hapus</button>
        </div>
    </div>
</div>

<script>
window.onload = function () {
    // Set auto date-time lokal ke input
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    document.getElementById('tanggal').value = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Handler toggle box NIP Dosen
    const kategori = document.getElementById('kategori');
    const nipBox = document.getElementById('nipBox');

    kategori.addEventListener('change', function () {
        if (this.value == 'dosen' || this.value == 'pengajaran') {
            nipBox.style.display = 'block';
            document.getElementById('nip').setAttribute('required', 'required');
        } else {
            nipBox.style.display = 'none';
            document.getElementById('nip').removeAttribute('required');
        }
    });

    // Control modal konfirmasi hapus
    let deleteUrl = "";
    document.querySelectorAll(".btn-delete-feedback").forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            deleteUrl = this.href;
            document.getElementById("modalDelete").style.display = "flex";
        });
    });

    document.getElementById("btnBatal").onclick = function () {
        document.getElementById("modalDelete").style.display = "none";
    };

    document.getElementById("btnYa").onclick = function () {
        window.location.href = deleteUrl;
    };
};
</script>

@endsection