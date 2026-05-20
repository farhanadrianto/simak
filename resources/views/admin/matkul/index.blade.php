@extends('layouts.admin')

@section('content')

<style>
    /* --- HEADER & TOPBAR --- */
    .topbar-manage {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .topbar-manage h1 {
        margin: 0;
        font-size: 24px;
        color: #f8fafc;
    }
    .topbar-manage p {
        margin: 5px 0 0;
        color: #94a3b8;
        font-size: 14px;
    }

    /* --- SEARCH BOX (Modern Dark) --- */
    .search-container {
        margin-bottom: 25px;
    }
    .search-input {
        width: 100%;
        padding: 14px 20px;
        background: #1e293b;
        border: 1px solid #334155;
        border-radius: 12px;
        color: white;
        font-size: 14px;
        outline: none;
        transition: 0.3s;
    }
    .search-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    /* --- BUTTONS --- */
    .btn-tambah {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-tambah:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    }

    /* --- TABLE STYLING (Glassmorphism Identity) --- */
    .table-container {
        background: #111827;
        border-radius: 16px;
        border: 1px solid #1e293b;
        overflow: hidden;
    }
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .admin-table th {
        background: rgba(30, 41, 59, 0.5);
        padding: 16px;
        color: #94a3b8;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #1e293b;
    }
    .admin-table td {
        padding: 16px;
        color: #e2e8f0;
        font-size: 14px;
        border-bottom: 1px solid #1e293b;
    }
    .admin-table tr:last-child td {
        border-bottom: none;
    }
    .admin-table tr:hover {
        background: rgba(255, 255, 255, 0.02);
    }

    /* --- BADGES --- */
    .badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
    }
    .badge.mkr { background: rgba(16, 185, 129, 0.1); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); }
    .badge.mku { background: rgba(56, 189, 248, 0.1); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.2); }

    /* --- ACTION BUTTONS --- */
    .action-group {
        display: flex;
        gap: 8px;
    }
    .btn-edit {
        background: rgba(245, 158, 11, 0.1);
        color: #fbbf24;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 12px;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    .btn-edit:hover { background: #fbbf24; color: #000; }
    
    .btn-hapus {
        background: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid rgba(239, 68, 68, 0.2);
        font-size: 12px;
        cursor: pointer;
    }
    .btn-hapus:hover { background: #ef4444; color: white; }
</style>

<div class="topbar-manage">
    <div>
        <h1>Kelola Mata Kuliah</h1>
        <p>Manajemen data kurikulum FIK</p>
    </div>
    <a href="/admin/matkul/create" class="btn-tambah">
        <span>+</span> Tambah Mata Kuliah
    </a>
</div>

<div class="search-container">
    <input type="text" id="searchInput" class="search-input" placeholder="Cari berdasarkan kode atau nama mata kuliah...">
</div>

<div class="table-container">
    <table class="admin-table" id="matkulTable">
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>NAMA</th>
                <th>KELAS</th>
                <th>HARI/JAM</th>
                <th>SKS</th>
                <th>JENIS</th>
                <th>PRODI</th>
                <th>KAPASITAS</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matkuls as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-family: monospace; color: #818cf8;">{{ $m->kode_matkul }}</td>
                <td style="font-weight: 600;">{{ $m->nama_matkul }}</td>
                <td>{{ $m->kelas }}</td>
            <td>
                <div style="font-weight: 600; color: #e2e8f0;">{{ $m->hari }}</div>
                <div style="font-size: 13px; color: #94a3b8; margin-top: 2px;">
                    {{ $m->jam_mulai }} — {{ $m->jam_selesai }}
                </div>
            </td>
                <td>{{ $m->sks }}</td>
                <td>
                    <span class="badge {{ strtolower($m->jenis) }}">
                        {{ $m->jenis }}
                    </span>
                </td>
                <td>{{ $m->kode_prodi }}</td>
                <td>
                    <span style="color: #94a3b8;">{{ $m->kapasitas }} Mahasiswa</span>
                </td>
                <td>
                    <div class="action-group">
                        <a href="{{ route('matkul.edit',$m->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('matkul.destroy',$m->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus matkul ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Real-time Search Logic
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelector("#matkulTable tbody").rows;

        for (let i = 0; i < rows.length; i++) {
            let kodeText = rows[i].cells[1].textContent.toLowerCase();
            let namaText = rows[i].cells[2].textContent.toLowerCase();

            if (kodeText.includes(filter) || namaText.includes(filter)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>

@endsection