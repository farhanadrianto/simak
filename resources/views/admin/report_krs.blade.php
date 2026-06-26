@extends('layouts.admin')

@section('content')

<style>
    .chart-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: #0f172a;
    }

    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .btn-back {
        display: inline-block;
        padding: 10px 20px;
        background: #f1f5f9;
        color: #475569;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-back:hover { background: #e2e8f0; color: #1e293b; }
</style>

<div class="chart-card">
    <div class="chart-title">🥧 Status KRS Mahasiswa</div>
    
    <div class="chart-container">
        <canvas id="chartKrs"></canvas>
    </div>
</div>

<a href="{{ route('admin.report') }}" class="btn-back">← Kembali</a>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataKrs = @json($statusKrs);

        // Fungsi untuk menentukan warna berdasarkan label status
        // Pastikan penulisan kata di sini sama persis dengan yang tersimpan di database
        const getColor = (status) => {
            const s = status.toLowerCase();
            if (s.includes('disetujui')) return '#22c55e'; // Hijau
            if (s.includes('ditolak'))   return '#ef4444'; // Merah
            if (s.includes('menunggu'))  return '#f59e0b'; // Kuning/Amber
            return '#94a3b8'; // Warna cadangan (abu-abu)
        };

        if (typeof Chart !== 'undefined') {
            const ctx = document.getElementById('chartKrs').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: dataKrs.map(item => item.status),
                    datasets: [{
                        data: dataKrs.map(item => item.total),
                        // Menentukan warna secara dinamis berdasarkan status
                        backgroundColor: dataKrs.map(item => getColor(item.status)),
                        borderWidth: 2,
                        borderColor: '#ffffff' // Memberi jarak putih antar slice pie
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { 
                            position: 'right',
                            labels: { 
                                color: '#475569', 
                                font: { size: 14, weight: '600' },
                                padding: 20
                            } 
                        } 
                    }
                }
            });
        }
    });
</script>

@endsection