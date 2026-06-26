@extends('layouts.admin')

@section('content')

<style>
    /* Tema Terang (Konsisten dengan Create & Index) */
    .form-container {
        max-width: 700px;
        margin: 20px auto;
        background: #ffffff5b;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    h1 { font-size: 1.5rem; margin-bottom: 5px; color: #0f172a; }
    .subtitle { color: #64748b; font-size: 0.9rem; margin-bottom: 30px; }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
    .field-label { display: block; font-size: 0.8rem; color: #475569; margin-bottom: 6px; font-weight: 600; text-transform: uppercase; }

    .input-wrapper { position: relative; display: flex; align-items: center; }
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

    /* Style khusus Readonly */
    input[readonly] {
        background: #f8fafc;
        color: #64748b;
        cursor: not-allowed;
        border: 1px solid #e2e8f0;
    }

    .readonly-wrapper::after {
        content: '🔒';
        position: absolute;
        right: 12px;
        font-size: 0.8rem;
        opacity: 0.5;
    }

    input:focus:not([readonly]), select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .button-group { display: flex; gap: 10px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .btn-update { height: 40px; padding: 0 24px; font-weight: 600; border-radius: 8px; border: none; cursor: pointer; background: #1e3a8a; color: white; }
    .btn-back { height: 40px; padding: 0 24px; font-weight: 600; border-radius: 8px; border: 1px solid #e2e8f0; cursor: pointer; background: #f8fafc; color: #475569; text-decoration: none; display: flex; align-items: center; }
    .btn-update:hover { background: #1e40af; }
    .btn-back:hover { background: #f1f5f9; }

    @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
</style>

<div class="form-container">
    <h1>Edit Mata Kuliah</h1>
    <p class="subtitle">Data dengan ikon gembok tidak dapat diubah.</p>

    <form action="{{ route('matkul.update', $matkul->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div>
                <label class="field-label">Kode Mata Kuliah *</label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="kode_matkul" value="{{ $matkul->kode_matkul }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Nama Mata Kuliah *</label>
                <input name="nama_matkul" value="{{ $matkul->nama_matkul }}" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Kelas *</label>
                <input name="kelas" value="{{ $matkul->kelas }}" required>
            </div>
            <div>
                <label class="field-label">Hari</label>
                <select name="hari" required>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari)
                        <option value="{{ $hari }}" {{ $matkul->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Jam Mulai *</label>
                <input type="time" name="jam_mulai" value="{{ $matkul->jam_mulai }}" required>
            </div>
            <div>
                <label class="field-label">Jam Selesai *</label>
                <input type="time" name="jam_selesai" value="{{ $matkul->jam_selesai }}" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">SKS *</label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="sks" value="{{ $matkul->sks }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Jenis</label>
                <select name="jenis" required>
                    <option value="MKR" {{ $matkul->jenis == 'MKR' ? 'selected' : '' }}>MKR</option>
                    <option value="MKU" {{ $matkul->jenis == 'MKU' ? 'selected' : '' }}>MKU</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label class="field-label">Kode Program Studi *</label>
                <div class="input-wrapper readonly-wrapper">
                    <input name="kode_prodi" value="{{ $matkul->kode_prodi }}" readonly>
                </div>
            </div>
            <div>
                <label class="field-label">Kapasitas</label>
                <input type="number" name="kapasitas" value="{{ $matkul->kapasitas }}" required>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-update">Simpan Perubahan</button>
            <a href="/admin/matkul" class="btn-back">Kembali</a>
        </div>
    </form>
</div>

@endsection