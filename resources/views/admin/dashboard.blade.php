@extends('layouts.admin')

@section('content')

<style>
.container {
    max-width: 1100px;
}

.welcome-box {
    background: #020617;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
}

.welcome-box h1 {
    color: #6366f1;
}

.welcome-box p {
    color: #94a3b8;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
    gap: 20px;
}

.card {
    background: #020617;
    padding: 20px;
    border-radius: 12px;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card-title {
    font-weight: bold;
    margin-bottom: 10px;
}

.card-desc {
    color: #94a3b8;
    font-size: 13px;
}

.card-link {
    display: inline-block;
    margin-top: 10px;
    color: #6366f1;
    text-decoration: none;
}
</style>

<div class="container">

    <div class="welcome-box">
        <h1>🎉 Selamat Datang Admin!</h1>
        <p>
            Login sebagai <b>{{ Auth::user()->nik }}</b>
        </p>
    </div>

    <div class="dashboard-grid">

        <div class="card">
            <div class="card-title">📚 Mata Kuliah</div>
            <div class="card-desc">Kelola data mata kuliah</div>
            <a href="/admin/matkul" class="card-link">Buka →</a>
        </div>

        <div class="card">
            <div class="card-title">📢 Pengumuman</div>
            <div class="card-desc">Kelola pengumuman</div>
            <a href="/admin/pengumuman" class="card-link">Buka →</a>
        </div>

    </div>

</div>

@endsection