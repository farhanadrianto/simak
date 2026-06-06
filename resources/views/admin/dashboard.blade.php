@extends('layouts.admin')

@section('content')

<style>
.container {
    width: 100%; /* Mengubah max-width menjadi width 100% agar full ke kanan saat zoom 80% */
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
    grid-template-columns: repeat(auto-fit, minmax(300px,1fr));
    gap: 20px;
}

.card {
    background: #020617;
    padding: 24px;
    border-radius: 12px;
    transition: .3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card-title {
    font-weight: 700;
    margin-bottom: 10px;
    font-size: 16px;
}

.card-desc {
    color: #94a3b8;
    font-size: 13px;
    line-height: 1.6;
}

.card-link {
    display: inline-block;
    margin-top: 15px;
    color: #6366f1;
    text-decoration: none;
    font-weight: 600;
}
</style>

<div class="container">

    <div class="welcome-box">
        <h1>🎉 Selamat Datang Admin!</h1>

        <p>
            Login sebagai <b>{{ Auth::user()->nik }}</b>
        </p>
    </div>

</div>

@endsection