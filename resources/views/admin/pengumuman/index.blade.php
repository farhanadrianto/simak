@extends('layouts.admin')

@section('content')

<style>
/* ===== TOPBAR ===== */
.topbar {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}
.btn-tambah {
    background:linear-gradient(135deg,#6366f1,#3b82f6);
    padding:10px 18px;
    border-radius:8px;
    color:white;
    text-decoration:none;
    font-weight:500;
}

/* ===== TABLE ===== */
.table-container {
    background:#020617;
    border-radius:12px;
    padding:20px;
}

table {
    width:100%;
    border-collapse:collapse;
}

th {
    text-align:left;
    font-size:13px;
    color:#94a3b8;
    padding:12px;
}

td {
    padding:14px 12px;
    border-top:1px solid #1e293b;
}

tr:hover {
    background:#0f172a;
}

/* ===== BUTTON ===== */
.btn-edit {
    background:#2563eb;
    padding:6px 12px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    font-size:13px;
}

.btn-hapus {
    background:#dc2626;
    padding:6px 12px;
    border:none;
    border-radius:6px;
    color:white;
    font-size:13px;
    cursor:pointer;
}

/* isi pendek */
.isi {
    max-width:250px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* penting biar rapi */
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #1f2937;
    text-align: left; /* paksa rata kiri */
    vertical-align: middle;
}

th {
    color: #9ca3af;
    font-size: 13px;
}

/* ukuran tiap kolom biar stabil */
th:nth-child(1), td:nth-child(1) { width: 60px; }
th:nth-child(2), td:nth-child(2) { width: 250px; }
th:nth-child(3), td:nth-child(3) { width: 300px; }
th:nth-child(4), td:nth-child(4) { width: 180px; }
th:nth-child(5), td:nth-child(5) { width: 150px; }

/* isi biar gak melebar */
.isi {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-edit {
    margin-right: 6px;
}
</style>

<div class="topbar">
    <div>
        <h1>Pengumuman</h1>
        <p>Kelola data pengumuman</p>
    </div>

    <a href="{{ route('pengumuman.create') }}" class="btn-tambah">
        + Tambah Pengumuman
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pengumuman as $p)
            <tr>
                <td>{{ $p->id }}</td>

                <td>{{ $p->judul }}</td>

                <td class="isi">{{ $p->isi }}</td>

                <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y H:i') }}</td>

                <td>
                    <a href="{{ route('pengumuman.edit',$p->id) }}" class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('pengumuman.destroy',$p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-hapus"
                        onclick="return confirm('Yakin hapus pengumuman ini?')">
                        Hapus
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:30px; color:#94a3b8;">
                    Belum ada pengumuman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection