@extends('layouts.admin')

@section('content')

<style>
    /* --- HEADER & TOPBAR --- */
    .topbar-manage { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .topbar-manage h1 { margin: 0; font-size: 24px; color: #0f172a; font-weight: 700; }
    .topbar-manage p { margin: 5px 0 0; color: #64748b; font-size: 14px; }

    /* --- SEARCH BOX --- */
    .search-input {
        width: 100%;
        padding: 14px 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 25px;
        transition: 0.3s;
    }
    .search-input:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }

    /* --- TABLE STYLING --- */
    .table-container { background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .admin-table { width: 100%; border-collapse: collapse; text-align: left; }
    .admin-table th { background: #f8fafc; padding: 16px; color: #475569; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
    .admin-table td { padding: 16px; color: #1e293b; font-size: 14px; border-bottom: 1px solid #e2e8f0; }
    
    /* --- BADGES (Disesuaikan dengan warna biru tema) --- */
    .badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: uppercase; }
    .badge.mkr { background: #dcfce7; color: #166534; }
    .badge.mku { background: #e0f2fe; color: #075985; }

    /* --- ACTION BUTTONS --- */
    .action-group { display: flex; gap: 8px; }
    .btn-edit { background: #fffbeb; color: #92400e; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; border: 1px solid #fde68a; }
    .btn-hapus { background: #fef2f2; color: #991b1b; padding: 6px 12px; border-radius: 6px; border: 1px solid #fecaca; cursor: pointer; font-size: 12px; }
</style>

<div class="topbar-manage">
    <div>
        <h1>Kelola Mata Kuliah</h1>
        <p>Manajemen data kurikulum Fakultas Ilmu Komputer</p>
    </div>
    <a href="/admin/matkul/create" class="btn-tambah" style="background: #1e3a8a; color: white; padding: 12px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px;">
        + Tambah Mata Kuliah
    </a>
</div>

<input type="text" id="searchInput" class="search-input" placeholder="Cari berdasarkan kode atau nama mata kuliah...">

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
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matkuls as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: 700; color: #1e3a8a;">{{ $m->kode_matkul }}</td>
                <td style="font-weight: 600;">{{ $m->nama_matkul }}</td>
                <td>{{ $m->kelas }}</td>
                <td>
                    <div style="font-weight: 600;">{{ $m->hari }}</div>
                    <div style="font-size: 12px; color: #64748b;">{{ $m->jam_mulai }} - {{ $m->jam_selesai }}</div>
                </td>
                <td>{{ $m->sks }}</td>
                <td>
                    <span class="badge {{ strtolower($m->jenis) }}">{{ $m->jenis }}</span>
                </td>
                <td>{{ $m->kode_prodi }}</td>
                <td>
                    <div class="action-group">
                        <a href="{{ route('matkul.edit', $m->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('matkul.destroy', $m->id) }}" method="POST" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalDelete" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.5); backdrop-filter: blur(4px); justify-content:center; align-items:center; z-index:9999;">
    <div style="width:400px; background:white; border-radius:16px; padding:30px; text-align:center; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
        <h3 style="color:#1e293b; margin-bottom:10px;">Konfirmasi Hapus</h3>
        <p style="color:#64748b; margin-bottom:25px;">Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.</p>
        <div style="display:flex; justify-content:center; gap:12px;">
            <button id="btnBatal" style="padding:10px 20px; background:#f1f5f9; border:none; border-radius:8px; cursor:pointer;">Batal</button>
            <button id="btnYa" style="padding:10px 20px; background:#dc2626; color:white; border:none; border-radius:8px; cursor:pointer;">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
    let formTarget = null;
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            formTarget = this;
            document.getElementById('modalDelete').style.display = 'flex';
        });
    });

    document.getElementById('btnBatal').onclick = () => document.getElementById('modalDelete').style.display = 'none';
    document.getElementById('btnYa').onclick = () => formTarget.submit();

    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#matkulTable tbody tr");
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>

@endsection