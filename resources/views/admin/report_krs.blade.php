@extends('layouts.admin')

@section('content')

<style>

.btn-back{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 16px;
    background:#1e293b;
    color:#cbd5e1;
    text-decoration:none;
    border-radius:8px;
}

.btn-back:hover{
    background:#334155;
    color:white;
}

.chart-card{
    background:#020617;
    padding:25px;
    border-radius:12px;
}

.chart-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:20px;
}

canvas{
    max-height:500px;
}

</style>

<a href="{{ route('admin.report') }}"
   class="btn-back">
    ← Kembali
</a>

<div class="chart-card">

    <div class="chart-title">
        🥧 Status KRS Mahasiswa
    </div>

    <canvas id="chartKrs"></canvas>

</div>

<script>

const dataKrs = @json($statusKrs);

new Chart(document.getElementById('chartKrs'), {

    type: 'pie',

    data: {

        labels: dataKrs.map(item => item.status),

        datasets: [{
            data: dataKrs.map(item => item.total),

            backgroundColor: [
                '#facc15',
                '#22c55e',
                '#ef4444'
            ]
        }]
    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                position: 'right',

                labels: {
                    color: '#ffffff'
                }

            }

        }

    }

});

</script>

@endsection