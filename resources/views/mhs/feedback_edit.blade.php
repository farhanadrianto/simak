@extends('layouts.mhs')

@section('content')

<style>
    /* ===== TITLE ===== */
    .section-title {
        color: #059669; /* Hijau Emerald Segar */
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    /* ===== FORM CARD (SOFT LIGHT THEME) ===== */
    .form-card {
        background: #ffffff; /* Mengganti warna gelap ke putih solid */
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
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
    .btn {
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

    .btn:hover {
        opacity: 0.95;
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
    }

    .btn-back {
        background: #f1f5f9; 
        color: #475569;
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ===== LABELS ===== */
    .form-label {
        color: #475569;
        font-weight: 600;
        font-size: 14px;
        display: block;
        margin-bottom: 8px;
    }
</style>

<div class="section-title">Edit Feedback</div>

<div class="form-card">
    <h3 style="color: #0f172a; font-size: 18px; font-weight: 700; margin-bottom: 24px;">✏️ Perbarui Data Feedback</h3>

    <form action="{{ route('mhs.feedback.update', $data->id) }}" method="POST">
        @csrf

        <div style="margin-bottom: 18px;">
            <label class="form-label">NPM</label>
            <input type="text" class="input input-readonly" value="{{ auth()->user()->npm }}" readonly>
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Kategori Feedback</label>
            <select name="kategori" id="kategori" class="input" required>
                <option value="dosen" {{ $data->kategori == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="pengajaran" {{ $data->kategori == 'pengajaran' ? 'selected' : '' }}>Pengajaran</option>
                <option value="fasilitas" {{ $data->kategori == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
            </select>
        </div>

        <div id="nipBox" style="margin-bottom: 18px;">
            <label class="form-label">NIP Dosen</label>
            <select name="nip" id="nip">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosen as $d)
                    <option value="{{ $d->nip }}" {{ $data->nip == $d->nip ? 'selected' : '' }}>
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
                        <input type="radio" name="rating" value="{{ $i }}" {{ $data->rating == $i ? 'checked' : '' }} required>
                        <span>{{ str_repeat('⭐', $i) }} {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <div style="margin-bottom: 18px;">
            <label class="form-label">Isi Feedback</label>
            <textarea name="isi" rows="4" placeholder="Bagaimana pengalaman Anda?" required>{{ $data->isi }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label class="form-label">Tanggal</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="input" required>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <button type="submit" class="btn">Update Feedback</button>
            <a href="{{ route('mhs.feedback') }}" class="btn-back">
                ← Kembali
            </a>
        </div>
    </form>
</div>

<script>
    const kategori = document.getElementById('kategori');
    const nipBox = document.getElementById('nipBox');

    function toggleNip() {
        if (kategori.value === 'dosen' || kategori.value === 'pengajaran') {
            nipBox.style.display = 'block';
            document.getElementById('nip').setAttribute('required', 'required');
        } else {
            nipBox.style.display = 'none';
            document.getElementById('nip').removeAttribute('required');
        }
    }

    // Jalankan saat pertama kali halaman dimuat
    toggleNip();

    kategori.addEventListener('change', toggleNip);

    // Ambil data tanggal yang tersimpan dari database lama
    // Membantu memvalidasi format datetime-local (YYYY-MM-DDTHH:MM)
    const oldDateStr = "{{ $data->tanggal }}"; 
    if(oldDateStr) {
        const dateObj = new Date(oldDateStr);
        if(!isNaN(dateObj.getTime())) {
            const year = dateObj.getFullYear();
            const month = String(dateObj.getMonth() + 1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            const hours = String(dateObj.getHours()).padStart(2, '0');
            const minutes = String(dateObj.getMinutes()).padStart(2, '0');
            document.getElementById('tanggal').value = `${year}-${month}-${day}T${hours}:${minutes}`;
        }
    }
</script>

@endsection