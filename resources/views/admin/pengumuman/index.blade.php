@extends('layouts.admin')

@section('content')

<style>
    /* --- DASHBOARD LAYOUT --- */
    .dashboard-container { width: 100%; display: flex; flex-direction: column; gap: 20px; }

    /* --- TOPBAR --- */
    .topbar-manage { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
    .topbar-manage h1 { margin: 0; font-size: 24px; color: #0f172a; font-weight: 700; }
    .topbar-manage p { margin: 5px 0 0; color: #64748b; font-size: 14px; }

    /* --- BUTTONS --- */
    .btn-tambah {
        background: #1e3a8a; color: white; padding: 12px 20px; border-radius: 10px;
        text-decoration: none; font-weight: 600; font-size: 14px;
        transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-tambah:hover { background: #1e40af; }

    /* --- TABLE (LIGHT MODE) --- */
    .table-container { 
        background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; 
        overflow: hidden; width: 100%; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .admin-table { width: 100%; border-collapse: collapse; text-align: left; }
    .admin-table th { 
        background: #f8fafc; padding: 18px 20px; color: #475569; 
        font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0;
    }
    .admin-table td { padding: 16px 20px; color: #1e293b; font-size: 14px; border-bottom: 1px solid #e2e8f0; }
    .admin-table tr:hover { background: #f1f5f9; }

    /* --- ACTION BUTTONS --- */
    .action-group { display: flex; gap: 8px; }
    .btn-edit { background: #fffbeb; color: #92400e; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; border: 1px solid #fde68a; }
    .btn-hapus { background: #fef2f2; color: #991b1b; padding: 6px 12px; border-radius: 6px; border: 1px solid #fecaca; cursor: pointer; font-size: 12px; }
    .btn-edit:hover { background: #fde68a; }
    .btn-hapus:hover { background: #fee2e2; }
</style>

<div class="dashboard-container">

    <div class="topbar-manage">
        <div>
            <h1>Pengumuman</h1>
            <p>Kelola data pengumuman yang ditampilkan pada sistem</p>
        </div>
        <a href="{{ route('pengumuman.create') }}" class="btn-tambah">+ Tambah Pengumuman</a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>JUDUL</th>
                    <th>ISI</th>
                    <th>TANGGAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumuman as $p)
                <tr>
                    <td style="color: #64748b;">#{{ $p->id }}</td>
                    <td style="font-weight: 600;">{{ $p->judul }}</td>
                    <td style="color: #475569; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        {{ $p->isi }}
                    </td>
                    <td style="font-size: 13px;">{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('pengumuman.edit', $p->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('pengumuman.destroy', $p->id) }}" method="POST" class="delete-form">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-hapus btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">Data belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modalDelete" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.4); backdrop-filter: blur(2px); justify-content:center; align-items:center; z-index:9999;">
    <div style="width:400px; background:white; border-radius:16px; padding:30px; text-align:center; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
        <h3 style="color:#0f172a; margin-bottom:10px;">Hapus Pengumuman?</h3>
        <p style="color:#64748b; margin-bottom:25px;">Data ini akan dihapus secara permanen.</p>
        <div style="display:flex; justify-content:center; gap:12px;">
            <button id="btnBatal" style="padding:10px 20px; background:#f1f5f9; border:none; border-radius:8px; color:#475569; cursor:pointer;">Batal</button>
            <button id="btnYa" style="padding:10px 20px; background:#dc2626; border:none; border-radius:8px; color:white; cursor:pointer;">Ya, Hapus</button>
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
</script>

@endsection