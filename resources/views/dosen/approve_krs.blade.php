@extends('layouts.dosen')

@section('content')

<style>
.container{
    max-width:1100px;
    margin:auto;
}

.title{
    margin-bottom:30px;
}

.title h1{
    font-size:42px;
    font-weight:700;
}

.title span{
    color:#a78bfa;
}

.search-box{
    width:100%;
    max-width:480px;
    padding:14px 18px;
    background:#111827;
    border:1px solid #374151;
    border-radius:14px;
    color:white;
    margin-bottom:30px;
    outline:none;
}

.card{
    background:#111827;
    border-radius:20px;
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#221b3a;
    color:#a78bfa;
    text-align:left;
    padding:20px;
    font-size:14px;
}

td{
    padding:22px 20px;
    border-top:1px solid #1f2937;
}

.status{
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.menunggu{
    background:rgba(251,146,60,.15);
    color:#fb923c;
}

.disetujui{
    background:rgba(74,222,128,.15);
    color:#4ade80;
}

.ditolak{
    background:rgba(248,113,113,.15);
    color:#f87171;
}

.btn{
    padding:10px 16px;
    border-radius:10px;
    background:rgba(74,222,128,.12);
    color:#86efac;
    text-decoration:none;
    border:1px solid rgba(74,222,128,.2);
    font-size:13px;
    font-weight:600;
}

.empty{
    text-align:center;
    padding:40px;
    color:#9ca3af;
}
</style>

<div class="container">

    <div class="title">
        <h1>
            Persetujuan <span>KRS Mahasiswa</span>
        </h1>
    </div>

    <input
        type="text"
        id="searchInput"
        class="search-box"
        placeholder="Cari NPM mahasiswa..."
    >

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NPM</th>
                    <th>TOTAL SKS</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody id="tableBody">

                @forelse($krs as $i => $k)

                <tr>
                    <td>{{ $i + 1 }}</td>

                    <td class="npm">
                        {{ $k->npm }}
                    </td>

                    <td>
                        {{ $k->total_sks }}/24
                    </td>

                    <td>
                        <span class="status {{ $k->status }}">
                            {{ ucfirst($k->status) }}
                        </span>
                    </td>

                    <td>
                        <a
                            href="{{ route('dosen.approve.detail', $k->npm) }}"
                            class="btn"
                        >
                            Detail
                        </a>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="empty">
                        Belum ada pengajuan KRS
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>
const searchInput = document.getElementById('searchInput');
const rows = document.querySelectorAll('#tableBody tr');

searchInput.addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    rows.forEach((row)=>{

        let npm = row.querySelector('.npm');

        if(!npm) return;

        let text = npm.innerText.toLowerCase();

        if(text.includes(keyword)){
            row.style.display = '';
        }else{
            row.style.display = 'none';
        }

    });

});
</script>

@endsection