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
    color:#a78bfa;
    letter-spacing:2px;
}

.title h1{
    font-size:32px;
    font-weight:700;
}

/* CARD */
.card{
    background:#111827;
    border-radius:14px;
    padding:20px;
    margin-bottom:20px;
}

/* SEARCH */
.search-box{
    width:100%;
    max-width:400px;
    padding:12px;
    border-radius:10px;
    border:1px solid #374151;
    background:#1f2937;
    color:white;
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

.rating{
    background:#1f2937;
    padding:6px 12px;
    border-radius:8px;
    color:#a78bfa;
    font-size:12px;
}

/* BUTTON */
.btn{
    padding:6px 14px;
    border-radius:8px;
    background:#1f2937;
    color:#a78bfa;
    text-decoration:none;
    font-size:12px;
}

/* NO DATA */
.no-data{
    color:#9ca3af;
    margin-top:10px;
}
</style>

<div class="container">

    <!-- HEADER -->
    <div class="title">
        <small>PORTAL DOSEN</small>
        <h1>Feedback <span style="color:#a78bfa;">Mahasiswa</span></h1>
        <p style="color:#9ca3af; margin-top:8px;">
            Program Studi: {{ $prodi->nama_prodi ?? '-' }}
        </p>
    </div>

    <!-- CARD HEADER -->
    <div class="card">
        <h3>Feedback dari Mahasiswa</h3>
        <p style="color:#9ca3af; font-size:14px;">
            Menampilkan feedback mahasiswa {{ $prodi->nama_prodi ?? '-' }}
        </p>

        <br>

        <!-- 🔥 SEARCH (WAJIB ADA ID) -->
        <input type="text" id="searchInput" class="search-box" placeholder="Cari NPM mahasiswa...">
    </div>

    <!-- TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NPM</th>
                    <th>RATING</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <!-- 🔥 WAJIB ADA ID -->
            <tbody id="tableBody">
                @forelse($feedback as $i => $f)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $f->npm }}</td>
                    <td>
                        <span class="rating">
                            {{ number_format($f->avg_rating,1) }}/5
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('dosen.feedback.detail', $f->npm) }}" class="btn">
                            Detail
                        </a>
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

        <!-- 🔥 NO DATA SEARCH -->
        <p id="noData" class="no-data" style="display:none;">
            Data tidak ditemukan
        </p>
    </div>

</div>

<!-- 🔥 JS LIVE SEARCH -->
<script>
const searchInput = document.getElementById('searchInput');
const rows = document.querySelectorAll('#tableBody tr');
const noData = document.getElementById('noData');

searchInput.addEventListener('keyup', function () {
    const keyword = this.value.toLowerCase();
    let ditemukan = false;

    rows.forEach(row => {
        // skip row kosong (Belum ada feedback)
        if(row.children.length < 2) return;

        const npm = row.children[1].innerText.toLowerCase();

        if (npm.includes(keyword)) {
            row.style.display = '';
            // BARIS INI DIHAPUS: row.children[0].innerText = nomor++; 
            ditemukan = true;
        } else {
            row.style.display = 'none';
        }
    });

    noData.style.display = ditemukan ? 'none' : 'block';
});
</script>

@endsection