@extends('layouts.admin')

@section('content')

<style>
/* --- MAIN CONTAINER --- */
.dashboard-container {
    width: 100%;
    padding: 10px 0;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    gap: 20px; 
}

/* --- WELCOME BANNER --- */
.welcome-box {
    background: #ffffff; /* Putih bersih agar kontras dengan sidebar biru */
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.welcome-box h1 {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px 0;
}

.welcome-box b {
    color: #1e3a8a; /* Warna Biru Tua sesuai Sidebar */
    background: #dbeafe;
    padding: 2px 8px;
    border-radius: 6px;
}

/* --- GRIDS --- */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 16px; 
}

/* --- CARDS --- */
.card {
    background: #ffffff; 
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: all 0.2s ease;
}

.card:hover {
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
}

.card h3 {
    margin: 0;
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
}

.number {
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
}

.label {
    font-size: 11px;
    color: #94a3b8;
    font-weight: 500;
}

/* --- JAM DIGITAL --- */
.clock {
    font-size: 22px;
    font-weight: 700;
    color: #1e3a8a;
    font-family: 'Courier New', Courier, monospace;
}

@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>

<div class="dashboard-container">

    <div class="welcome-box">
        <h1>🎉 Selamat Datang, Admin</h1>
        <p style="color: #64748b;">Login sebagai <b>{{ Auth::user()->nik ?? 'Administrator' }}</b></p>
    </div>

    <div class="stats-grid">
        @php
            $items = [
                ['title' => 'Mahasiswa', 'count' => $totalMahasiswa, 'icon' => '👨‍🎓'],
                ['title' => 'Dosen', 'count' => $totalDosen, 'icon' => '👨‍🏫'],
                ['title' => 'Mata Kuliah', 'count' => $totalMatkul, 'icon' => '📚'],
                ['title' => 'Pengumuman', 'count' => $totalPengumuman, 'icon' => '📢'],
                ['title' => 'Feedback', 'count' => $totalFeedback, 'icon' => '💬'],
            ];
        @endphp

        @foreach($items as $item)
        <div class="card">
            <h3>{{ $item['icon'] }} {{ $item['title'] }}</h3>
            <div class="number">{{ $item['count'] }}</div>
            <div class="label">TOTAL {{ strtoupper($item['title']) }}</div>
        </div>
        @endforeach
    </div>

    <!-- Jam Digital dalam box lebar 1 kolom di posisi bawah -->
    <div style="width: 250px;">
        <div class="card">
            <h3>🕒 Jam Digital</h3>
            <div id="clock" class="clock"></div>
            <div class="label">{{ config('app.timezone') }}</div>
        </div>
    </div>

</div>

<script>
function updateClock(){
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    document.getElementById("clock").innerHTML = new Date().toLocaleTimeString("id-ID", options);
}
updateClock();
setInterval(updateClock, 1000);
</script>

@endsection