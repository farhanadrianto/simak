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
    <div class="chart-title">💬 Total Feedback per Program Studi</div>
    
    <div class="chart-container">
        <canvas id="chartFeedback"></canvas>
    </div>
</div>

<a href="{{ route('admin.report') }}" class="btn-back">← Kembali</a>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataFeedback = @json($totalFeedbackProdi);

        if (typeof Chart !== 'undefined') {
            const ctx = document.getElementById('chartFeedback').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataFeedback.map(item => item.nama_prodi),
                    datasets: [{
                        label: 'Total Feedback',
                        data: dataFeedback.map(item => item.total),
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