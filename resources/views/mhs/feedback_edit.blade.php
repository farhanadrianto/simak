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

    .input-readonly {
        background: #334155 !important; 
        color: #94a3b8 !important;
        cursor: not-allowed; 
        border: 1px solid #475569;
    }

    .input:focus:not(.input-readonly), textarea:focus {
        border-color: #34d399;
    }

    .rating-box {
        display: flex;
        gap: 12px;
        margin-top: 10px;
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
    }

    .rating-box input {
        display: none;
    }

    .rating-box label:has(input:checked) {
        border-color: #34d399;
        background: rgba(52, 211, 153, 0.1);
    }

    .rating-box input:checked + span {
        color: #facc15;
        font-weight: bold;
    }

    .btn {
        background: #34d399;
        color: #020617;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn:hover {
        background: #10b981;
    }

.btn-back {
    background: #334155; /* abu2 gelap */
    color: #e2e8f0;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    transition: 0.2s;
}

.btn-back:hover {
    background: #475569;
}

select{
    width:100%;
    background:#020617;
    border:1px solid #334155;
    color:white;
    padding:14px;
    border-radius:12px;
    outline:none;
    font-size:15px;
    transition:.3s;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;

    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='white' viewBox='0 0 16 16'%3E%3Cpath d='M1.5 5l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 15px center;
    padding-right:45px;
}

select:focus{
    border-color:#34d399;
    box-shadow:0 0 0 2px rgba(52,211,153,.15);
}

select option{
    background:#0f172a;
    color:white;
}
</style>

<div class="form-card">
    <h3 style="color: white; margin-bottom: 20px;">Edit Feedback</h3>

    <form action="{{ route('mhs.feedback.update', $data->id) }}" method="POST">
        @csrf
        

        <!-- NPM -->
        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8;">NPM</label>
            <input type="text" class="input input-readonly" value="{{ auth()->user()->npm }}" readonly>
        </div>

        <!-- Kategori -->
<div style="margin-bottom: 15px;">
    <label style="color: #94a3b8;">Kategori Feedback</label>

    <select name="kategori" id="kategori" class="input" required>

        <option value="dosen"
            {{ $data->kategori == 'dosen' ? 'selected' : '' }}>
            Dosen
        </option>

        <option value="pengajaran"
            {{ $data->kategori == 'pengajaran' ? 'selected' : '' }}>
            Pengajaran
        </option>

        <option value="fasilitas"
            {{ $data->kategori == 'fasilitas' ? 'selected' : '' }}>
            Fasilitas
        </option>

    </select>
</div>

<!-- NIP -->
<div id="nipBox" style="margin-bottom:15px;">

    <label style="color: #94a3b8;">
        NIP Dosen
    </label>

<select name="nip" id="nip">

    <option value="">-- Pilih Dosen --</option>

    @foreach($dosen as $d)
        <option
            value="{{ $d->nip }}"
            {{ $data->nip == $d->nip ? 'selected' : '' }}>
            {{ $d->nip }} - {{ $d->nama_lengkap }}
        </option>
    @endforeach

</select>

</div>

        <!-- Rating -->
        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8;">Rating</label>
            <div class="rating-box">
                @for($i=1; $i<=5; $i++)
                    <label>
                        <input type="radio" name="rating" value="{{ $i }}" 
                            {{ $data->rating == $i ? 'checked' : '' }} required>
                        <span>{{ str_repeat('⭐', $i) }} {{ $i }}</span>
                    </label>
                @endfor
            </div>
        </div>

        <!-- Isi -->
        <div style="margin-bottom: 15px;">
            <label style="color: #94a3b8;">Isi Feedback</label>
            <textarea name="isi" rows="4" required>{{ $data->isi }}</textarea>
        </div>

        <!-- Tanggal -->
        <div style="margin-bottom: 20px;">
            <label style="color: #94a3b8;">Tanggal</label>
<input
    type="datetime-local"
    name="tanggal"
    id="tanggal"
    class="input"
    required>
        </div>

<div style="display:flex; gap:10px;">
    <button type="submit" class="btn">Update Feedback</button>

    <a href="{{ route('mhs.feedback') }}" class="btn-back">
        ← Kembali
    </a>
</div>
</div>

<script>

const kategori =
    document.getElementById('kategori');

const nipBox =
    document.getElementById('nipBox');

function toggleNip(){

    if(
        kategori.value === 'dosen' ||
        kategori.value === 'pengajaran'
    ){
        nipBox.style.display = 'block';
    }else{
        nipBox.style.display = 'none';
    }

}

toggleNip();

kategori.addEventListener('change', toggleNip);

const now = new Date();

const year = now.getFullYear();
const month = String(now.getMonth() + 1).padStart(2, '0');
const day = String(now.getDate()).padStart(2, '0');
const hours = String(now.getHours()).padStart(2, '0');
const minutes = String(now.getMinutes()).padStart(2, '0');

document.getElementById('tanggal').value =
`${year}-${month}-${day}T${hours}:${minutes}`;
</script>

@endsection