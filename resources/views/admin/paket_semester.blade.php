@extends('layouts.admin')

@section('content')

<style>
    /* --- HEADER --- */
    .page-title { color: #0f172a; font-size: 28px; font-weight: 700; margin-bottom: 5px; }
    .page-subtitle { color: #64748b; margin-bottom: 25px; font-size: 14px; }

    /* --- TABLE (LIGHT MODE) --- */
    .table-wrapper { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 16px; 
        overflow: hidden; 
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .table-custom { width: 100%; border-collapse: collapse; }
    .table-custom th { 
        background: #f8fafc; color: #475569; padding: 18px 20px; 
        text-align: left; font-size: 12px; font-weight: 600; text-transform: uppercase;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-custom td { padding: 16px 20px; color: #1e293b; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
    .table-custom tr:hover { background: #f1f5f9; }

    /* --- BADGES --- */
    .badge-semester { background: #eff6ff; color: #1e40af; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .badge-mkr { background: #ecfdf5; color: #065f46; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .badge-mku { background: #fffbeb; color: #92400e; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }

    .empty-state { text-align: center; padding: 40px; color: #64748b; }
</style>

<h1 class="page-title">📦 Paket Semester 2</h1>
<p class="page-subtitle">Daftar mata kuliah paket yang otomatis diambil mahasiswa semester awal.</p>

<div class="table-wrapper">
    <table class="table-custom">
        <thead>
            <tr>
                <th>SEMESTER</th>
                <th>KODE</th>
                <th>MATA KULIAH</th>
                <th>SKS</th>
                <th>JENIS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
            <tr>
                <td><span class="badge-semester">Semester {{ $d->semester }}</span></td>
                <td style="font-family: monospace; font-weight: 600;">{{ $d->kode_matkul }}</td>
                <td style="font-weight: 500;">{{ $d->nama_matkul }}</td>
                <td><strong>{{ $d->sks }}</strong></td>
                <td>
                    @if($d->jenis == 'MKR')
                        <span class="badge-mkr">MKR</span>
                    @else
                        <span class="badge-mku">MKU</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-state">Belum ada data paket semester tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection