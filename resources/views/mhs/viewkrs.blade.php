@extends('layouts.mhs')

@section('content')

<style>
/* Update pada bagian krs-wrapper */
.krs-wrapper {
    display: flex;
    flex-direction: column;
    gap: 30px;
    
    /* 1. Gedein ini (vh = % tinggi layar). Coba 80 atau 85 */
    min-height: 80vh; 
    
    /* 2. Tambah padding bottom biar gak nempel banget ke ujung bawah browser */
    padding-bottom: 100px; 
}

/* Update pada table-wrapper agar aman di layar kecil / zoom besar */
.table-wrapper {
    width: 100%;
    overflow-x: auto; /* 🔥 Biar kalau di-zoom, tabelnya bisa di-scroll ke samping, gak hancur */
    background: #111827;
    border-radius: 18px;
    border: 1px solid #1f2937;
}

.table-krs {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px; /* 🔥 Mencegah tabel jadi "gepeng" saat kolom banyak */
}

/* Hilangkan border-radius di table-krs karena sudah ada di wrapper-nya */
.table-krs {
    background: transparent; 
}

.table-krs th{
    background:rgba(16,185,129,.12);
    color:#34d399;
    padding:14px;
    font-size:13px;
    text-align:left;
}

.table-krs td{
    padding:14px;
    border-bottom:1px solid #1f2937;
    color:white;
}

.table-krs tr:hover{
    background:rgba(16,185,129,.04);
}

.badge{
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.badge-menunggu{
    background:rgba(251,146,60,.15);
    color:#fb923c;
}

.badge-disetujui{
    background:rgba(16,185,129,.15);
    color:#34d399;
}

.badge-ditolak{
    background:rgba(239,68,68,.15);
    color:#f87171;
}

.btn-hapus{
    padding:8px 14px;
    border-radius:10px;
    background:rgba(239,68,68,.12);
    color:#fca5a5;
    border:1px solid rgba(239,68,68,.25);
    cursor:pointer;
    font-weight:600;
}

.btn-hapus:hover{
    background:rgba(239,68,68,.2);
}

/* Pastikan summary tidak menempel */
.summary {
    /* Ini tetap 'auto' supaya dia selalu cari posisi paling bawah yang tersedia */
    margin-top: auto; 
    
    background: rgba(16, 185, 129, .08);
    border: 1px solid rgba(16, 185, 129, .15);
    border-radius: 16px;
    padding: 25px;
    color: white;
    width: 100%;
}

.summary-flex {
    display: flex;
    /* 🔥 Balikkan ke space-between agar satu di kiri, satu di kanan */
    justify-content: space-between; 
    align-items: center;
    gap: 20px;
    flex-wrap: wrap; /* 🔥 Tetap pakai wrap biar pas di-zoom gak hancur */
}

.progress-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 300px; /* Kamu bisa atur lebar bar-nya di sini */
    min-width: 200px;
    /* 🔥 Tambahkan margin-left auto sebagai pengaman tambahan */
    margin-left: auto; 
}

/* Teks info SKS */
.summary h3, .summary p {
    margin: 0;
    /* Hapus white-space: nowrap; agar lebih aman saat layar sangat sempit */
}

.progress-bar{
    flex:1;
    height:14px;
    background:rgba(16,185,129,.18);
    border-radius:999px;
    overflow:hidden;
}

.progress-fill{
    height:100%;
    background:linear-gradient(90deg,#10b981,#059669);
    border-radius:999px;
}

.modal-delete{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.65);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:9999;
}

.modal-box{
    width:420px;
    background:#0f172a;
    border:1px solid #1e293b;
    border-radius:18px;
    padding:28px;
    color:white;
    text-align:center;
}

.modal-box h3{
    margin-bottom:12px;
    color:#f87171;
}

.modal-box p{
    color:#94a3b8;
    margin-bottom:25px;
}

.modal-action{
    display:flex;
    justify-content:center;
    gap:15px;
}

.btn-batal{
    background:#334155;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:10px;
    cursor:pointer;
}

.btn-ya{
    background:#ef4444;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:10px;
    cursor:pointer;
}

.btn-batal:hover{
    background:#475569;
}

.btn-ya:hover{
    background:#dc2626;
}
</style>

<h1 style="color:white; font-size:38px;">
    Kartu Rencana Studi <span style="color:#34d399;">(KRS)</span>
</h1>



@if(session('success'))
<div style="
    background:rgba(16,185,129,.12);
    border:1px solid rgba(16,185,129,.3);
    color:#34d399;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
">
    {{ session('success') }}
</div>
@endif

<p style="color:#94a3b8; margin-bottom:30px;">
    Lihat dan kelola KRS Anda di sini
</p>

@if(auth()->user()->semester == 2)

<form action="{{ route('mhs.krs.ambilPaket') }}" method="POST"
      style="margin-bottom:20px;">
    @csrf

    <button type="submit"
        style="
            background:#10b981;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:10px;
            font-weight:600;
            cursor:pointer;
        "
        onclick="return confirm('Ambil seluruh paket semester?')">

        📦 Ambil Paket Semester 2
    </button>
</form>

@endif

<div class="krs-wrapper">

    <div class="table-wrapper">
        <table class="table-krs">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE</th>
                    <th>MATA KULIAH</th>
                    <th>SKS</th>
                    <th>KELAS</th>
                    <th>HARI</th>
                    <th>JAM</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @foreach($krs as $i => $row)

@php
    $bentrok = false;

    foreach ($krs as $j => $cek) {
        if ($i != $j) {
            if (
                $row->hari == $cek->hari &&
                $row->jam_mulai < $cek->jam_selesai &&
                $row->jam_selesai > $cek->jam_mulai
            ) {
                $bentrok = true;
                break;
            }
        }
    }
@endphp
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->kode_matkul }}</td>
                    <td>{{ $row->nama_matkul }}</td>
                    <td><b>{{ $row->sks }}</b></td>
                    <td>{{ $row->kelas }}</td>
                    <td>{{ $row->hari }}</td>
                    <td>{{ $row->jam_mulai }} - {{ $row->jam_selesai }}</td>

                    <td>
@if($bentrok)
    <span class="badge badge-ditolak">
        ⚠️ Jadwal Bertabrakan
    </span>
@else
    <span class="badge badge-{{ $row->status }}">
        @if($row->status == 'menunggu')
            ⏳ Menunggu
        @elseif($row->status == 'disetujui')
            ✓ Disetujui
        @else
            ✗ Ditolak
        @endif
    </span>
@endif
                    </td>

                    <td>
<form action="{{ route('mhs.krs.delete', $row->id) }}"
      method="POST"
      style="display:inline;"
      class="form-hapus">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-hapus">
                                ✕ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <div class="summary">
        <div class="summary-flex">
            <div>
                <h3 style="margin:0 0 10px 0;">📊 Total SKS</h3>
<p style="margin:0;color:#94a3b8;">
    Total SKS Anda:
    <b style="color:white">{{ $totalSks }}</b> dari {{ $maxSks }} SKS
</p>
                <p style="margin-top:8px;color:#94a3b8;">
                    Sisa kuota:
                   <b style="color:white">{{ $maxSks - $totalSks }} SKS</b>
                </p>
            </div>

            <div class="progress-wrapper">
                <div class="progress-bar">
                    <div class="progress-fill"
                         style="width: {{ min(($totalSks / $maxSks) * 100, 100) }}%">
                    </div>
                </div>
                <span style="color:#94a3b8;">
                    {{ round(($totalSks / $maxSks) * 100, 1) }}%
                </span>
            </div>
        </div>
    </div>

</div>

<div class="modal-delete" id="modalDelete">

    <div class="modal-box">

        <h3>🗑️ Hapus KRS</h3>

        <p>
            Apakah Anda yakin ingin menghapus mata kuliah ini?
        </p>

        <div class="modal-action">

            <button class="btn-batal" id="btnBatal">
                Batal
            </button>

            <button class="btn-ya" id="btnYa">
                Ya, Hapus
            </button>

        </div>

    </div>

</div>

<script>
    let formDelete = null;

document.querySelectorAll(".form-hapus").forEach(form=>{

    form.addEventListener("submit",function(e){

        e.preventDefault();

        formDelete=this;

        document.getElementById("modalDelete").style.display="flex";

    });

});

document.getElementById("btnBatal").onclick=function(){

    document.getElementById("modalDelete").style.display="none";

};

document.getElementById("btnYa").onclick=function(){

    formDelete.submit();

};
</script>
@endsection