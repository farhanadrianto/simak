@extends('layouts.admin')

@section('content')

<style>
.page-title{
    color:#34d399;
    font-size:38px;
    font-weight:700;
    margin-bottom:10px;
}

.page-subtitle{
    color:#94a3b8;
    margin-bottom:25px;
}

.table-wrapper{
    background:#111827;
    border:1px solid #1f2937;
    border-radius:18px;
    overflow:hidden;
}

.table-custom{
    width:100%;
    border-collapse:collapse;
}

.table-custom th{
    background:rgba(16,185,129,.12);
    color:#34d399;
    padding:16px;
    text-align:left;
    font-size:13px;
    font-weight:600;
}

.table-custom td{
    padding:16px;
    color:white;
    border-bottom:1px solid #1f2937;
}

.table-custom tr:hover{
    background:rgba(16,185,129,.04);
}

.badge-semester{
    background:rgba(59,130,246,.15);
    color:#60a5fa;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.badge-mkr{
    background:rgba(16,185,129,.15);
    color:#34d399;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.badge-mku{
    background:rgba(251,191,36,.15);
    color:#fbbf24;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.empty-state{
    text-align:center;
    padding:40px;
    color:#94a3b8;
}
</style>

<h1 class="page-title">
    📦 Paket Semester
</h1>

<p class="page-subtitle">
    Daftar mata kuliah paket yang otomatis diambil mahasiswa semester awal.
</p>

<div class="table-wrapper">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Semester</th>
                <th>Kode</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Jenis</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $d)
            <tr>
                <td>
                    <span class="badge-semester">
                        Semester {{ $d->semester }}
                    </span>
                </td>

                <td>{{ $d->kode_matkul }}</td>

                <td>{{ $d->nama_matkul }}</td>

                <td>
                    <strong>{{ $d->sks }}</strong>
                </td>

                <td>
                    @if($d->jenis == 'MKR')
                        <span class="badge-mkr">
                            MKR
                        </span>
                    @else
                        <span class="badge-mku">
                            MKU
                        </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-state">
                    Belum ada data paket semester.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection