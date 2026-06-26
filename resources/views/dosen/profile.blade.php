@extends('layouts.dosen')

@section('content')

<style>
    /* ===== PROFILE CONTAINER ===== */
    .profile-container {
        max-width: 1000px;
        margin: auto;
        padding-bottom: 40px;
    }

    /* ===== SECTION TITLES ===== */
    .section-title {
        color: #1e40af; /* Biru Royal */
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        text-transform: uppercase;
    }

    /* ===== MINIMALIST WHITE CARD ===== */
    .card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.03);
    }

    /* ===== PHOTO BOX COMPONENT ===== */
    .photo-box {
        width: 110px;
        height: 110px;
        border-radius: 50%; /* Diubah bulat agar lebih modern & clean */
        border: 2px dashed #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #f8fafc;
        transition: border-color 0.2s ease;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-upload {
        margin-top: 8px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 8px;
        color: #334155;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-upload:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ===== FORM CONTROL LAYOUT ===== */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    label {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #475569;
    }

    input, textarea {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 12px 16px;
        color: #0f172a;
        font-size: 14px;
        font-weight: 500;
        outline: none;
        transition: all 0.2s ease;
    }

    input:focus, textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    input::placeholder, textarea::placeholder {
        color: #94a3b8;
    }

    /* ===== READONLY & LOCK COMPONENT ===== */
    .readonly {
        background: #f8fafc !important;
        color: #64748b !important;
        border-color: #e2e8f0 !important;
        cursor: not-allowed;
        font-weight: 600;
    }

    .lock {
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ===== INTERACTIVE SAVE BUTTON ===== */
    .btn-save {
        background: #2563eb;
        border: none;
        padding: 12px 28px;
        border-radius: 10px;
        color: white;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.15);
    }

    .btn-save:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 6px 12px rgba(37, 99, 235, 0.2);
    }

    #fotoInput {
        display: none;
    }

    /* ===== SOFT SUCCESS ALERT ===== */
    .alert {
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 14px;
        font-weight: 600;
        transition: opacity 0.5s ease;
    }

    .alert-success { 
        background: #f0fdf4; 
        border: 1px solid rgba(34, 197, 94, 0.2); 
        color: #15803d; 
    }
</style>

<div class="profile-container">

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('dosen.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="section-title">Foto Profil</div>
        <div class="card">
            <div style="display: flex; gap: 24px; align-items: center;">
                <div class="photo-box">
                    <img id="previewFoto" 
                         src="{{ $profile->foto_profil ? asset('uploads/profile/'.$profile->foto_profil) : asset('assets/img/default-avatar.png') }}"
                         alt="Foto Profil">
                </div>
                <div>
                    <p style="color: #64748b; font-size: 13px; font-weight: 500; margin: 0 0 8px 0;">
                        Format berkas yang diterima: <strong>JPG, PNG, WEBP</strong> (Maksimal 2MB)
                    </p>
                    <input type="file" id="fotoInput" name="foto" accept="image/*">
                    <button type="button" class="btn-upload" onclick="document.getElementById('fotoInput').click()">
                        📷 Ubah Foto
                    </button>
                </div>
            </div>
        </div>

        <div class="section-title">Informasi Utama Dosen</div>
        <div class="card">
            
            <div class="form-row">
                <div class="form-group">
                    <label>NIP (Nomor Induk Pegawai)</label>
                    <input type="text" value="{{ $profile->nip }}" class="readonly" readonly>
                    <div class="lock">🔒 Tidak dapat diubah</div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap & Gelar</label>
                    <input type="text" name="nama_lengkap" 
                           value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" 
                           placeholder="Contoh: Dr. Ir. Nama Lengkap, M.T.">
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

            <div class="form-group">
                <label>Alamat Domisili</label>
                <textarea name="alamat" placeholder="Contoh: Jl. Merdeka No. 123, Blok C, Kota Surabaya"
                          style="min-height: 90px; font-family: inherit; resize: vertical;">{{ old('alamat', $profile->alamat) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Program Studi</label>
                    <input type="text" value="{{ $prodi->nama_prodi ?? '-' }}" class="readonly" readonly>
                    <div class="lock">🔒 Tidak dapat diubah</div>
                </div>
                <div class="form-group"></div>
            </div>

            <div style="text-align: right; margin-top: 15px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
                <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

<script>
    // Live Preview Image File Loader
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

    // Alert Auto-Fadeout Handler (3 Seconds timer)
    setTimeout(() => {
        const alertBox = document.querySelector('.alert');
        if(alertBox){
            alertBox.style.opacity = '0';
            setTimeout(() => alertBox.remove(), 500);
        }
    }, 3000);
</script>

@endsection