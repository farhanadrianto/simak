@extends('layouts.admin')

@section('content')

<style>
    /* Tema Terang */
    .form-container {
        max-width: 700px;
        margin: 20px auto;
        background: #ffffff5b;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    h1 { font-size: 1.5rem; margin-bottom: 5px; color: #0f172a; }
    p { color: #64748b; font-size: 0.9rem; margin-bottom: 30px; }

    .form-group { margin-bottom: 15px; }
    label { display: block; color: #475569; font-size: 0.8rem; margin-bottom: 6px; font-weight: 600; text-transform: uppercase; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    input, select {
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #1e293b;
        font-size: 0.95rem;
        box-sizing: border-box;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .button-group { display: flex; gap: 10px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #f1f5f9; }

    .btn-submit {
        height: 40px; padding: 0 24px; font-weight: 600; border-radius: 8px; border: none; cursor: pointer;
        background: #1e3a8a; /* Biru Tua sesuai Sidebar */
        color: white;
    }
    
    .btn-back {
        height: 40px; padding: 0 24px; font-weight: 600; border-radius: 8px; border: 1px solid #e2e8f0; cursor: pointer;
        background: #f8fafc; color: #475569; text-decoration: none; display: flex; align-items: center;
    }

    .btn-submit:hover { background: #1e40af; }
    .btn-back:hover { background: #f1f5f9; }

    @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
</style>

<div class="form-container">
    <h1>Tambah Mata Kuliah</h1>
    <p>Silakan isi data mata kuliah baru dengan lengkap.</p>

    <form method="POST" action="{{ route('matkul.store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>KODE MATA KULIAH</label>
                <input type="text" name="kode_matkul" required>
            </div>
            <div class="form-group">
                <label>NAMA MATA KULIAH</label>
                <input type="text" name="nama_matkul" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>KELAS</label>
                <input type="text" name="kelas" required>
            </div>
            <div class="form-group">
                <label>HARI</label>
                <select name="hari" required>
                    <option value="">Pilih Hari</option>
                    <option>Senin</option><option>Selasa</option><option>Rabu</option>
                    <option>Kamis</option><option>Jumat</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>JAM MULAI</label>
                <input type="time" name="jam_mulai" required>
            </div>
            <div class="form-group">
                <label>JAM SELESAI</label>
                <input type="time" name="jam_selesai" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>JUMLAH SKS</label>
                <input type="number" name="sks" required>
            </div>
            <div class="form-group">
                <label>JENIS</label>
                <select name="jenis" required>
                    <option value="">Pilih Jenis</option>
                    <option value="MKR">MKR</option>
                    <option value="MKU">MKU</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>KODE PRODI</label>
                <input type="text" name="kode_prodi" required>
            </div>
            <div class="form-group">
                <label>KAPASITAS</label>
                <input type="number" name="kapasitas" required>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-submit">Simpan Data</button>
            <a href="/admin/matkul" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

@endsection