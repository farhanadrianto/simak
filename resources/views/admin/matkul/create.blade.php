@extends('layouts.admin')

@section('content')

<style>
    /* Variabel Warna */
    :root {
        --bg-main: #0b1120;
        --bg-card: #111827;
        --bg-input: #1e293b;
        --text-primary: #f9fafb;
        --text-secondary: #94a3b8;
        --accent-indigo: #4f46e5;
        --accent-blue: #3b82f6;
    }

    /* Container dipersempit ke 600px */
    .form-container {
        max-width: 600px;
        margin: 20px auto;
        background: var(--bg-card);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    h1 {
        font-size: 1.25rem; /* Lebih kecil */
        margin-bottom: 4px;
        color: var(--text-primary);
    }

    p {
        color: var(--text-secondary);
        font-size: 0.85rem; /* Lebih kecil */
        margin-bottom: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px; /* Jarak antar input lebih rapat */
        margin-bottom: 12px;
    }

    /* Input & Select diperkecil */
    input, select {
        width: 100%;
        padding: 8px 12px; /* Padding lebih tipis */
        border-radius: 6px;
        border: 1px solid transparent;
        background: var(--bg-input);
        color: white;
        font-size: 0.85rem; /* Font input lebih kecil */
        box-sizing: border-box;
        transition: 0.2s;
    }

    input:focus, select:focus {
        outline: none;
        border-color: var(--accent-indigo);
    }

    /* Group Tombol */
    .button-group {
        display: flex;
        gap: 8px;
        margin-top: 20px;
    }

    /* Tombol dibuat lebih ramping & identik */
    .btn-submit, .btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 36px; /* Tinggi tombol diperkecil */
        padding: 0 16px;
        font-size: 0.85rem; /* Font tombol lebih kecil */
        font-weight: 500;
        border-radius: 6px;
        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;
        border: none;
        transition: opacity 0.2s;
    }

    .btn-submit {
        background: linear-gradient(90deg, var(--accent-indigo), var(--accent-blue));
        color: white;
    }

    .btn-back {
        background: #374151;
        color: #d1d5db;
    }

    .btn-submit:hover, .btn-back:hover {
        opacity: 0.85;
    }

    /* Responsif untuk HP */
    @media (max-width: 480px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-container">
    <h1>Tambah Mata Kuliah</h1>
    <p>Isi data mata kuliah</p>

    <form method="POST" action="/admin/matkul">
        @csrf

        <div class="form-row">
            <input type="text" name="kode_matkul" placeholder="Kode Matkul">
            <input type="text" name="nama_matkul" placeholder="Nama Matkul">
        </div>

        <div class="form-row">
            <input type="text" name="kelas" placeholder="Kelas">
            <select name="hari">
                <option value="">Pilih Hari</option>
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
            </select>
        </div>

        <div class="form-row">
            <input type="time" name="jam_mulai">
            <input type="time" name="jam_selesai">
        </div>

        <div class="form-row">
            <input type="number" name="sks" placeholder="SKS">
            <select name="jenis">
                <option value="">Jenis</option>
                <option value="MKR">MKR</option>
                <option value="MKU">MKU</option>
            </select>
        </div>

        <div class="form-row">
            <input type="text" name="kode_prodi" placeholder="Kode Prodi">
            <input type="number" name="kapasitas" placeholder="Kapasitas">
        </div>

        <div class="button-group">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="/admin/matkul" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

@endsection