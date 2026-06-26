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
    }

    /* Tombol Kembali di Bawah */
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
    <div class="chart-title">🎓 Jumlah Mahasiswa per Program Studi</div>
    
    <div class="chart-container">
        <canvas id="chartProdi"></canvas>
    </div>
</div>

<a href="{{ route('admin.report') }}" class="btn-back">← Kembali</a>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataProdi = @json($mhsPerProdi);

        if (typeof Chart !== 'undefined') {
            const ctx = document.getElementById('chartProdi').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataProdi.map(item => item.nama_prodi),
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: dataProdi.map(item => item.total),
                        backgroundColor: ['#38bdf8', '#22c55e', '#eab308', '#ef4444'],
                        borderRadius: 8,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#64748b' },
                            grid: { color: '#e2e8f0' }
                        },
                        x: {
                            ticks: { color: '#64748b' },
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
</script>

@endsection