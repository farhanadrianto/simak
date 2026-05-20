@extends('layouts.dosen')

@section('content')

<style>
.container{
    max-width:1100px;
    margin:auto;
}

/* TITLE */
.title{
    margin-bottom:25px;
}

.title small{
    color:#34d399;
    letter-spacing:2px;
}

.title h1{
    font-size:28px;
    font-weight:700;
}

/* CARD */
.card{
    background:#111827;
    border-radius:14px;
    padding:20px;
    margin-bottom:20px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    text-align:left;
    padding:14px;
    font-size:12px;
    color:#a78bfa;
    border-bottom:1px solid #374151;
}

td{
    padding:14px;
    border-bottom:1px solid #1f2937;
}

/* RATING */
.rating{
    background:#1f2937;
    padding:6px 12px;
    border-radius:8px;
    color:#a78bfa;
    font-size:12px;
}

/* BACK BUTTON */
.btn-back{
    display:inline-block;
    margin-bottom:15px;
    padding:8px 14px;
    background:#1f2937;
    border-radius:8px;
    color:#a78bfa;
    text-decoration:none;
    font-size:13px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="title">
        <small>PORTAL DOSEN</small>
        <h1>Detail Feedback Mahasiswa</h1>
        <p style="color:#9ca3af;">
            NPM: <b>{{ $npm }}</b>
        </p>
    </div>

    <!-- BACK -->
    <a href="{{ route('dosen.feedback') }}" class="btn-back">
        ← Kembali
    </a>

    <!-- TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>RATING</th>
                    <th>ISI FEEDBACK</th>
                    <th>TANGGAL</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedback as $i => $f)
                <tr>
                    <td>{{ $i+1 }}</td>

                    <td>
                        <span class="rating">
                            {{ $f->rating }}/5
                        </span>
                    </td>

                    <td style="color:#9ca3af;">
                        {{ $f->isi ?? '-' }}
                    </td>

                    <td style="color:#6b7280;">
                        {{ \Carbon\Carbon::parse($f->tanggal)->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; color:#9ca3af;">
                        Belum ada feedback
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection