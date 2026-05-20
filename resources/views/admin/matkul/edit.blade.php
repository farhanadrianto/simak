@extends('layouts.admin')

@section('content')

<style>
    :root {
        --bg-main: #0b1120;
        --bg-card: #111827;
        --bg-input: #1e293b;
        --bg-readonly: #161e2b;
        --text-primary: #f9fafb;
        --text-secondary: #94a3b8;
        --accent-indigo: #4f46e5;
        --accent-blue: #3b82f6;
        --accent-orange: #f59e0b; /* Warna gembok */
    }

    .form-container {
        max-width: 600px;
        margin: 20px auto;
        background: var(--bg-card);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.05);
        font-family: 'Inter', sans-serif;
    }

    h1 { font-size: 1.25rem; font-weight: 700; margin-bottom: 4px; color: var(--text-primary); }
    .subtitle { color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 25px; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .field-label {
        display: block;
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 6px;
    }

    /* Wrapper untuk posisi gembok */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    input, select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1.5px solid transparent;
        background: var(--bg-input);
        color: white;
        font-size: 0.9rem;
        box-sizing: border-box;
        transition: all 0.2s;
    }

    /* Padding kanan ekstra khusus untuk input readonly agar teks tidak tertutup gembok */
    input[readonly] {
        background: var(--bg-readonly);
        color: #94a3b8;
        cursor: not-allowed;
        padding-right: 35px; 
        border: 1.5px solid rgba(255, 255, 255, 0.05);
    }

    input:focus:not([readonly]), select:focus {
        outline: none;
        border-color: var(--accent-indigo);
    }

    /* Ikon Gembok menggunakan CSS Pseudo-element */
    .readonly-wrapper::after {
        content: '🔒'; /* Menggunakan emoji agar simple */
        position: absolute;
        right: 12px;
        font-size: 0.8rem;
        opacity: 0.7;
        filter: sepia(1) saturate(5) hue-rotate(10deg); /* Membuat emoji agak orange emas */
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-update, .btn-back {
        height: 40px;
        padding: 0 20px;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
        border: none;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-update { background: linear-gradient(90deg, #059669, #10b981); color: white; }
    .btn-back { background: #374151; color: #d1d5db; }
    .btn-update:hover { filter: brightness(1.1); transform: translateY(-1px); }

    @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
</style>

<div class="form-container">
    <h1>Edit Mata Kuliah</h1>
    <p class="subtitle">Data dengan ikon gembok tidak dapat diubah</p>

    <form action="{{ route('matkul.update', $matkul->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div>
                <label class="field-label">Kode Mata Kuliah <span style="color:red">*</span></label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="kode_matkul" value="{{ $matkul->kode_matkul }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Nama Mata Kuliah <span style="color:red">*</span></label>
                <input name="nama_matkul" value="{{ $matkul->nama_matkul }}">
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Kelas <span style="color:red">*</span></label>
                <input name="kelas" value="{{ $matkul->kelas }}">
            </div>
            <div>
                <label class="field-label">Hari</label>
                <select name="hari">
                    <option value="Senin" {{ $matkul->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $matkul->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $matkul->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $matkul->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $matkul->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Jam Mulai <span style="color:red">*</span></label>
                <input type="time" name="jam_mulai" value="{{ $matkul->jam_mulai }}">
            </div>
            <div>
                <label class="field-label">Jam Selesai <span style="color:red">*</span></label>
                <input type="time" name="jam_selesai" value="{{ $matkul->jam_selesai }}">
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">SKS <span style="color:red">*</span></label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="sks" value="{{ $matkul->sks }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Jenis</label>
                <select name="jenis">
                    <option value="MKR" {{ $matkul->jenis == 'MKR' ? 'selected' : '' }}>MKR</option>
                    <option value="MKU" {{ $matkul->jenis == 'MKU' ? 'selected' : '' }}>MKU</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Kode Program Studi <span style="color:red">*</span></label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="kode_prodi" value="{{ $matkul->kode_prodi }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Kapasitas</label>
                <input type="number" name="kapasitas" value="{{ $matkul->kapasitas }}">
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-update">Update Data</button>
            <a href="/admin/matkul" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

@endsection