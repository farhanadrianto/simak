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

    /* ===== MAIN CONTAINER & CARD ===== */
    .profile-container {
        max-width: 1100px;
        margin: auto;
        padding-bottom: 60px;
    }

    .card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 35px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }

    /* ===== PHOTO BOX COMPONENT ===== */
    .photo-box {
        width: 130px;
        height: 130px;
        border-radius: 16px;
        border: 2px dashed #bdd7ee; /* Border putus-putus lembut */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8fafc;
        transition: border-color 0.2s;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-upload {
        margin-top: 12px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        padding: 10px 20px;
        border-radius: 8px;
        color: #334155;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
    }

    .btn-upload:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ===== FORM LAYOUT SYSTEM ===== */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    label {
        font-size: 12px;
        margin-bottom: 8px;
        color: #475569;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    input, textarea {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 14px;
        color: #0f172a;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
    }

    input::placeholder, textarea::placeholder {
        color: #94a3b8; 
    }

    input:focus, textarea:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    textarea {
        min-height: 110px;
        font-family: inherit;
        resize: vertical;
    }

    /* ===== READONLY & LOCK COMPONENT ===== */
    .readonly {
        background: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
        cursor: not-allowed;
        font-weight: 500;
    }

    .lock {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
    }

    /* ===== ACTION BUTTON ===== */
    .btn-save {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        color: #ffffff;
        margin-top: 15px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        float: right;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .btn-save:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
    }

    .card::after {
        content: "";
        clear: both;
        display: table;
    }

    /* ===== NOTIFICATION ALERTS ===== */
    .alert {
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 14px;
        font-weight: 500;
        transition: opacity 0.3s ease;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #065f46;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #991b1b;
    }

    #fotoInput {
        display: none;
    }

    /* Responsive untuk layar kecil */
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }
</style>

<div class="profile-container">

@if(session('success'))
    <div class="alert alert-success" id="alertBox">
        ✅ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error" id="alertBox">
        ❌ {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('mhs.profile.update') }}" enctype="multipart/form-data">
@csrf

    <!-- BAGIAN FORM FOTO -->
    <div class="section-title">Foto Profil</div>
    <div class="card">
        <div style="display: flex; gap: 30px; align-items: center; flex-wrap: wrap;">
            <div class="photo-box">
                <img id="previewFoto"
                     src="{{ $profile->foto_profil ? asset('uploads/profile/'.$profile->foto_profil) : asset('assets/img/default-avatar.png') }}">
            </div>

            <div>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 10px 0; font-weight: 500;">
                    Format berkas yang diterima: JPG, PNG, WEBP (Maksimal 2MB)
                </p>
                <input type="file" id="fotoInput" name="foto" accept="image/*">
                <button type="button" class="btn-upload" onclick="document.getElementById('fotoInput').click()">
                    📷 Pilih Foto
                </button>
            </div>
        </div>
    </div>

    <!-- BAGIAN INFORMASI MAHASISWA -->
    <div class="section-title">Informasi Diri</div>
    <div class="card">

        <div class="form-row">
            <div class="form-group">
                <label>NPM (Nomor Pokok Mahasiswa)</label>
                <input type="text" value="{{ $profile->npm }}" class="readonly" readonly>
                <div class="lock">🔒 Tidak dapat diubah</div>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" 
                       value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" 
                       placeholder="Masukkan nama lengkap sesuai ijazah">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>No. HP / WhatsApp</label>
                <input type="text" name="nomor_wa" 
                       value="{{ old('nomor_wa', $profile->nomor_wa) }}" 
                       placeholder="Contoh: 081234567890">
            </div>

            <div class="form-group">
                <label>Email Kampus</label>
                <input type="email" value="{{ $profile->email_kampus }}" class="readonly" readonly>
                <div class="lock">🔒 Tidak dapat diubah</div>
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 25px;">
            <label>Alamat Domisili</label>
            <textarea name="alamat" 
                      placeholder="Contoh: Jl. Merdeka No. 10, Kecamatan Gambir, Jakarta Pusat">{{ old('alamat', $profile->alamat) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Program Studi</label>
                <input type="text" value="{{ $prodi->nama_prodi ?? '-' }}" class="readonly" readonly>
                <div class="lock">🔒 Tidak dapat diubah</div>
            </div>

            <div class="form-group">
                <label>Angkatan</label>
                <input type="text" value="{{ $profile->angkatan }}" class="readonly" readonly>
                <div class="lock">🔒 Tidak dapat diubah</div>
            </div>
        </div>

        <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
    </div>
</form>
</div>

<script>
// HANDLING INTERAKTIF PREVIEW FOTO KETIKA DIPILIH
document.getElementById('fotoInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('previewFoto').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// ANIMASI OTOMATIS MENGHAPUS NOTIFIKASI ALERT
setTimeout(() => {
    const alert = document.getElementById('alertBox');
    if(alert){
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }
}, 3000);
</script>

@endsection