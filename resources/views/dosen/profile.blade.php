@extends('layouts.dosen')

@section('content')

<style>
    .profile-container {
        background: linear-gradient(145deg, #0f172a, #020617);
        border: 1px solid rgba(255, 255, 255, .07);
        border-radius: 24px;
        padding: 30px;
        color: white;
        max-width: 1100px;
        margin: auto;
    }

    .section-title {
        color: #60a5fa;
        font-size: 13px;
        letter-spacing: 1px;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .card {
        background: #111827;
        border: 1px solid rgba(255, 255, 255, .06);
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 25px;
    }

    .photo-box {
        width: 120px;
        height: 120px;
        border-radius: 16px;
        border: 2px dashed #60a5fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #020617;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-upload {
        margin-top: 10px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        border: none;
        padding: 10px 16px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    label {
        font-size: 12px;
        margin-bottom: 6px;
        color: #9ca3af;
    }

    input, textarea {
        background: #1f2937;
        border: 1px solid #374151;
        border-radius: 10px;
        padding: 12px;
        color: white;
        outline: none;
        transition: 0.3s;
    }

    input:focus, textarea:focus {
        border-color: #60a5fa;
    }

    input::placeholder, textarea::placeholder {
        color: #4b5563;
    }

    .readonly {
        background: #374151 !important;
        color: #9ca3af !important;
        cursor: not-allowed;
    }

    .lock {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 4px;
    }

    .btn-save {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        border: none;
        padding: 12px 25px;
        border-radius: 12px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    #fotoInput {
        display: none;
    }

    .alert {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: 0.5s opacity;
    }
    .alert-success { 
        background: rgba(34, 197, 94, 0.2); 
        border: 1px solid #22c55e; 
        color: #4ade80; 
    }
</style>

<div class="profile-container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('dosen.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- FOTO SECTION -->
        <div class="section-title">Foto Profil</div>
        <div class="card">
            <div style="display:flex; gap:30px; align-items:center;">
                <div class="photo-box">
                    <img id="previewFoto" 
                         src="{{ $profile->foto_profil ? asset('uploads/profile/'.$profile->foto_profil) : asset('assets/img/default-avatar.png') }}">
                </div>
                <div>
                    <p style="color:#9ca3af; font-size:13px; margin-bottom: 8px;">
                        Format JPG, PNG, WEBP (Max 2MB)
                    </p>
                    <input type="file" id="fotoInput" name="foto" accept="image/*">
                    <button type="button" class="btn-upload" onclick="document.getElementById('fotoInput').click()">
                        📷 Pilih Foto
                    </button>
                </div>
            </div>
        </div>

        <!-- INFORMASI SECTION -->
        <div class="section-title">Informasi Dosen</div>
        <div class="card">
            
            <!-- BARIS 1 -->
            <div class="form-row">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" value="{{ $profile->nip }}" class="readonly" readonly>
                    <div class="lock">🔒 Tidak dapat diubah</div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" 
                           value="{{ old('nama_lengkap', $profile->nama_lengkap) }}" 
                           placeholder="Contoh: Dr. Ir. Nama Lengkap, M.T.">
                </div>
            </div>

            <!-- BARIS 2 -->
            <div class="form-row">
                <div class="form-group">
                    <label>No HP (WhatsApp)</label>
                    <input type="text" name="nomor_wa" 
                           value="{{ old('nomor_wa', $profile->nomor_wa) }}" 
                           placeholder="Contoh: 081234567890">
                </div>

<div class="form-group">
    <label>Email Kampus</label>
    <input
        type="email"
        value="{{ $profile->email_kampus }}"
        class="readonly"
        readonly>

    <div class="lock">🔒 Tidak dapat diubah</div>
</div>
            </div>

            <!-- BARIS 3: ALAMAT (LEBAR PENUH) -->
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" placeholder="Contoh: Jl. Merdeka No. 123, Kota"
                          style="min-height:100px; font-family:inherit;">{{ old('alamat', $profile->alamat) }}</textarea>
            </div>

            <!-- BARIS 4: PROGRAM STUDI (SEUKURAN NO HP) -->
            <div class="form-row">
                <div class="form-group">
                    <label>Program Studi</label>
                    <input type="text" value="{{ $prodi->nama_prodi ?? '-' }}" class="readonly" readonly>
                    <div class="lock">🔒 Tidak dapat diubah</div>
                </div>
                <!-- Spacer kosong agar Program Studi tidak melebar ke kanan -->
                <div class="form-group"></div>
            </div>

            <div style="text-align: right; margin-top: 10px;">
                <button type="submit" class="btn-save">💾 Simpan Profil</button>
            </div>
        </div>
    </form>
</div>

<script>
    // Preview Foto
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

    // Alert Auto Hide (3 Detik)
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert){
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>

@endsection