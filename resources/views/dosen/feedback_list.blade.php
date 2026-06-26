@extends('layouts.dosen')

@section('content')

<style>

.container{
    max-width:1200px;
    margin:auto;
}

.card{
    background:#111827;
    border-radius:14px;
    padding:20px;
    margin-bottom:20px;
}

.btn-back{
    display:inline-block;
    margin-bottom:20px;
    padding:10px 15px;
    background:#1e293b;
    color:#cbd5e1;
    text-decoration:none;
    border-radius:8px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    text-align:left;
    padding:12px;
    color:#a78bfa;
    border-bottom:1px solid #374151;
}

td{
    padding:12px;
    border-bottom:1px solid #1f2937;
}

.badge{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.dosen{
    background:#1e3a8a;
    color:#bfdbfe;
}

.pengajaran{
    background:#166534;
    color:#bbf7d0;
}

.fasilitas{
    background:#92400e;
    color:#fde68a;
}

.rating{
    background:#1f2937;
    padding:6px 10px;
    border-radius:8px;
}

</style>

<div class="container">

    <a href="{{ route('dosen.feedback') }}" class="btn-back">
        ← Kembali
    </a>

    <div class="card">

        <h2>{{ $title }}</h2>

        <br>

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Kategori</th>
                    <th>NIP</th>
                    <th>Rating</th>
                    <th>Isi Feedback</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($feedback as $i => $f)

                <tr>

                    <td>{{ $i + 1 }}</td>

                    <td>{{ $f->npm }}</td>

                    <td>

                        <span class="badge {{ $f->kategori }}">
                            {{ ucfirst($f->kategori) }}
                        </span>

                    </td>

                    <td>{{ $f->nip ?? '-' }}</td>

                    <td>
                        <span class="rating">
                            {{ $f->rating }}/5
                        </span>
                    </td>

                    <td>{{ $f->isi }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($f->tanggal)->format('d M Y H:i') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" style="text-align:center;color:#94a3b8;">
                        Belum ada feedback
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection