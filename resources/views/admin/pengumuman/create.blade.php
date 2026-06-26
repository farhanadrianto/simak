@extends('layouts.admin')

@section('content')

<style>
    /* --- LIGHT MODE FORM STYLES --- */
    .form-container {
        max-width: 700px;
        margin: 20px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    h2 { margin-bottom: 25px; color: #0f172a; font-size: 1.5rem; }

    .form-group { margin-bottom: 20px; }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 12px;
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        outline: none;
        transition: 0.2s;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-textarea { height: 150px; resize: vertical; }

    .button-group { margin-top: 30px; }

    .btn-simpan {
        background: #1e3a8a;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-simpan:hover { background: #1e40af; }

    .btn-kembali {
        display: inline-block;
        margin-left: 10px;
        padding: 12px 24px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-kembali:hover { background: #e2e8f0; }
</style>

<div class="form-container">
    <h2>Tambah Pengumuman</h2>

    <form action="{{ route('pengumuman.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-input" required placeholder="Masukkan judul pengumuman">
        </div>

        <div class="form-group">
            <label>Isi</label>
            <textarea name="isi" class="form-textarea" required placeholder="Tuliskan isi pengumuman..."></textarea>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="datetime-local" name="tanggal" id="inputTanggal" class="form-input" required>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-simpan">💾 Simpan Data</button>
            <a href="{{ route('pengumuman.index') }}" class="btn-kembali">← Kembali</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputTanggal = document.getElementById('inputTanggal');
        
        // Mengambil waktu lokal dan menyesuaikan dengan timezone pengguna
        const now = new Date();
        const offset = now.getTimezoneOffset();
        const adjustedDate = new Date(now.getTime() - (offset * 60 * 1000));
        
        // Set ke format yang didukung datetime-local
        inputTanggal.value = adjustedDate.toISOString().substring(0, 16);
    });
</script>

@endsection