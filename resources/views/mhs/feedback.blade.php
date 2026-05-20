@extends('layouts.mhs')

@section('content')

<style>
    .form-card {
        background: #0f172a;
        padding: 25px;
        border-radius: 14px;
        border: 1px solid #1e293b;
        margin-bottom: 30px;
    }

    .input, textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #1e293b;
        background: #020617;
        color: white;
        outline: none;
    }

    /* Style khusus untuk NPM / Readonly */
    .input-readonly {
        background: #334155 !important; 
        color: #94a3b8 !important;
        cursor: not-allowed; 
        border: 1px solid #475569;
    }

    .input:focus:not(.input-readonly), textarea:focus {
        border-color: #34d399;
    }

    /* Rating System Style */
    .rating-box {
        display: flex;
        gap: 12px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .rating-box label {
        background: #020617;
        border: 1px solid #1e293b;
        padding: 10px 15px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        user-select: none;
    }

    .rating-box input {
        display: none;
    }

    .rating-box label:has(input:checked) {
        border-color: #34d399;
        background: rgba(52, 211, 153, 0.1);
    }

    .btn-save {
        background: #34d399;
        color: #020617;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-save:hover {
        background: #10b981;
    }

    .feedback-item {
        background: #0f172a;
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 15px;
        border: 1px solid #1e293b;
    }

    /* 🔥 Style Tombol Aksi agar mirip Screenshot */
    .action-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-edit {
        color: #3b82f6;
        text-decoration: none;
        font-size: 0.85em;
        padding: 8px 16px;
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .btn-edit:hover {
        background: rgba(59, 130, 246, 0.2);
    }

    .btn-delete {
        color: #fca5a5;
        text-decoration: none;
        font-size: 0.85em;
        padding: 8px 16px;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
    }
</style>

<h2 style="color: #34d399; margin-bottom: 20px;">
    Buat Feedback
</h2>

<div class="form-card">
    <h3 style="color: white; margin-bottom: 20px;">💬 Tambah Feedback Baru</h3>

    <form action="{{ route('mhs.feedback.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8; display: block; margin-bottom: 8px;">NPM</label>
            <input type="text" class="input input-readonly" value="{{ auth()->user()->npm }}" readonly>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8; display: block; margin-bottom: 8px;">Rating Kepuasan</label>
            <div class="rating-box">
                @for($i=1; $i<=5; $i++)
                    <label>
                        <input type="radio" name="rating" value="{{ $i }}" required>
                        <span>{{ str_repeat('⭐', $i) }} {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8; display: block; margin-bottom: 8px;">Isi Feedback</label>
            <textarea name="isi" rows="4" placeholder="Bagaimana pengalaman Anda?" required></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="color: #94a3b8; display: block; margin-bottom: 8px;">Tanggal</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="input" required>
        </div>

        <button type="submit" class="btn-save">Simpan Feedback</button>
    </form>
</div>

<hr style="border: 0; border-top: 1px solid #1e293b; margin: 40px 0;">

<h3 style="color: #34d399; margin-bottom: 20px;">
    📋 Feedback Anda
</h3>

@foreach($data as $f)
    <div class="feedback-item">
        <div style="display: flex; justify-content: space-between; align-items: start; gap: 20px;">
            
            <!-- Konten (Kiri) -->
            <div style="flex: 1;">
                <span style="color: #facc15;">{{ str_repeat('⭐', $f->rating) }}</span>
                <span style="color: #64748b; font-size: 0.9em; margin-left: 5px;">({{ $f->rating }}/5)</span>
                <p style="color: white; margin-top: 10px; margin-bottom: 8px; line-height: 1.5;">{{ $f->isi }}</p>
                <small style="color: #475569;">{{ \Carbon\Carbon::parse($f->tanggal)->format('d M Y, H:i') }}</small>
            </div>

            <!-- Tombol Aksi (Kanan - Berdampingan) -->
            <div class="action-group">
                <a href="{{ route('mhs.feedback.edit', $f->id) }}" class="btn-edit">
                    ✏️ Edit
                </a>

                <a href="{{ route('mhs.feedback.delete', $f->id) }}" 
                   onclick="return confirm('Yakin ingin menghapus feedback ini?')"
                   class="btn-delete">
                    🗑️ Hapus
                </a>
            </div>

        </div>
    </div>
@endforeach

<script>
    window.onload = function() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('tanggal').value = currentDateTime;
    }
</script>

@endsection