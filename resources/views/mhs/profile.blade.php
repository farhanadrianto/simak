@extends('layouts.mhs')

@section('content')

<style>
.profile-container{
    background: linear-gradient(145deg,#0f172a,#020617);
    border:1px solid rgba(255,255,255,.07);
    border-radius:24px;
    padding: 35px;
    color:white;
    max-width:1100px;
    margin:auto;
}

.section-title{
    color:#34d399;
    font-size:13px;
    letter-spacing:1.5px;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.card{
    background:#111827;
    border:1px solid rgba(255,255,255,.06);
    border-radius:18px;
    padding: 30px;
    margin-bottom: 35px;
}

.photo-box{
    width:130px;
    height:130px;
    border-radius:16px;
    border:2px dashed #34d399;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    background:#020617;
}

.photo-box img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.btn-upload{
    margin-top:12px;
    background:linear-gradient(135deg,#10b981,#34d399);
    border:none;
    padding:10px 20px;
    border-radius:10px;
    color:white;
    cursor:pointer;
    font-weight: 500;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap: 25px;
    margin-bottom: 25px;
}

.form-group{
    display:flex;
    flex-direction:column;
    margin-bottom: 10px;
}

label{
    font-size:12px;
    margin-bottom: 8px;
    color:#9ca3af;
    font-weight: 500;
}

input, textarea{
    background:#1f2937;
    border:1px solid #374151;
    border-radius:10px;
    padding: 14px;
    color:white;
    outline: none;
    transition: 0.3s;
}

/* Style untuk Placeholder */
input::placeholder, textarea::placeholder {
    color: #4b5563; /* Warna abu-abu gelap agar tidak terlalu terang */
}

input:focus, textarea:focus {
    border-color: #34d399;
    box-shadow: 0 0 0 2px rgba(52, 211, 153, 0.1);
}

textarea{
    min-height: 100px;
    font-family: inherit;
    resize: vertical;
}

.readonly{
    background:#374151 !important;
    color:#9ca3af !important;
    cursor:not-allowed;
}

.lock{
    font-size:11px;
    color:#9ca3af;
    margin-top: 6px;
}

.btn-save{
    background:linear-gradient(135deg,#10b981,#34d399);
    border:none;
    padding: 14px 28px;
    border-radius:12px;
    color:white;
    margin-top: 10px;
    cursor:pointer;
    font-weight: bold;
    float: right;
}

.card::after {
    content: "";
    clear: both;
    display: table;
}

.alert{
    padding:16px 20px;
    border-radius:12px;
    margin-bottom:25px;
    transition:0.3s;
}

.alert-success{
    background: rgba(16,185,129,.15);
    border:1px solid rgba(16,185,129,.3);
    color:#6ee7b7;
}

.alert-error{
    background: rgba(239,68,68,.15);
    border:1px solid rgba(239,68,68,.3);
    color:#fca5a5;
}

#fotoInput{
    display:none;
}
</style>

<div class="profile-container">

@if(session('success'))
    <div class="alert alert-success" id="alertBox">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error" id="alertBox">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('mhs.profile.update') }}" enctype="multipart/form-data">
@csrf

    <!-- FOTO -->
    <div class="section-title">FOTO PROFIL</div>
    <div class="card">
        <div style="display:flex; gap:35px; align-items:center;">
            <div class="photo-box">
                <img id="previewFoto"
                     src="{{ $profile->foto_profil ? asset('uploads/profile/'.$profile->foto_profil) : asset('assets/img/default-avatar.png') }}">
            </div>

            <div>
                <p style="color:#9ca3af; font-size:13px; margin-bottom: 10px;">
                    Format JPG, PNG, WEBP (Max 2MB)
                </p>
                <input type="file" id="fotoInput" name="foto" accept="image/*">
                <button type="button" class="btn-upload"
                    onclick="document.getElementById('fotoInput').click()">
                    📷 Pilih Foto
                </button>
            </div>
        </div>
    </div>

    <!-- INFORMASI -->
    <div class="section-title">INFORMASI DIRI</div>
    <div class="card">

        <div class="form-row">
            <div class="form-group">
                <label>NPM</label>
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

        <div class="form-group" style="margin-bottom: 25px;">
            <label>Alamat</label>
            <textarea name="alamat" 
                      placeholder="Contoh: Jl. Merdeka No. 10, Jakarta Pusat">{{ old('alamat', $profile->alamat) }}</textarea>
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

        <button type="submit" class="btn-save">💾 Simpan Profil</button>
    </div>
</form>
</div>

<script>
// PREVIEW FOTO
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

// AUTO HILANG ALERT
setTimeout(() => {
    const alert = document.getElementById('alertBox');
    if(alert){
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }
}, 3000);
</script>

@endsection