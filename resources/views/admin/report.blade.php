@extends('layouts.admin')

@section('content')

<style>
.report-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:20px;
}

.card{
    background:#020617;
    padding:24px;
    border-radius:12px;
}

.card-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:10px;
}

.card-desc{
    color:#94a3b8;
    font-size:14px;
}

.card-link{
    display:inline-block;
    margin-top:15px;
    color:#6366f1;
    text-decoration:none;
}
</style>

<div class="report-grid">

    <div class="card">

        <div class="card-title">
            🎓 Grafik Mahasiswa per Program Studi
        </div>

        <div class="card-desc">
            Menampilkan jumlah mahasiswa berdasarkan program studi.
        </div>

        <a href="{{ route('admin.report.mahasiswa') }}"
           class="card-link">
            Lihat →
        </a>

    </div>

    <div class="card">

        <div class="card-title">
            💬 Grafik Feedback per Program Studi
        </div>

        <div class="card-desc">
            Menampilkan total feedback mahasiswa berdasarkan program studi.
        </div>

        <a href="{{ route('admin.report.feedback') }}"
           class="card-link">
            Lihat →
        </a>

    </div>

    <div class="card">

    <div class="card-title">
        🥧 Grafik Status KRS
    </div>

    <div class="card-desc">
        Menampilkan jumlah KRS berdasarkan status
        Menunggu, Disetujui dan Ditolak.
    </div>

    <a href="{{ route('admin.report.krs') }}"
       class="card-link">
        Lihat →
    </a>

</div>

</div>

@endsection