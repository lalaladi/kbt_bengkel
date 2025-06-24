@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kiri -->
        <div class="col-md-7">
            <div class="card p-4 mb-4 shadow-sm">
                <h5 class="mb-3">Details Rental</h5>
                <img src="{{ asset('img/map.png') }}" class="mb-3" alt="Map Preview">

                <div class="d-flex align-items-center mb-2">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//89/MTA-1726352/kawasaki_kawasaki-ninja-250-sepeda-motor---red--otr-jadetabekser-_full02.jpg" alt="Motor" class="me-3" style="height: 150px;">
                    <div>
                        <strong>Ninja 250</strong><br>
                        Motor Manual<br>
                        <small>#9761</small>
                    </div>
                </div>

                <div class="mb-2">
                    <div>
                        <input type="radio" checked> <strong>Pick-Up</strong> <br>
                        <div class="d-flex justify-content-between">
                            <strong>Locations</strong>
                            <span>Perumdos blok G</span>
                            <span>20 July 2022 - 07:00</span>
                        </div>
                    </div>
                    <br>
                    <div>
                        <input type="radio"> <strong>Drop-Off</strong> <br>
                        <div class="d-flex justify-content-between">
                            <strong>Locations</strong>
                            <span>Informatika</span>
                            <span>21 July 2022 - 01:00</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <strong>Total Price</strong>
                    <h1>$60.00</h1>
                    <small class="text-muted">Overall price and includes discount</small>
                </div>
            </div>
        </div>

        <!-- Kanan -->
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h5 class="mb-3">Progress</h5>

                <div class="d-flex justify-content-center mb-3">
                    <canvas id="progressDonutChart" width="250" height="250"></canvas>
                </div>

                <ul class="mt-2" style="list-style: none; padding-left: 0;">
                    <li><span style="color:#007BFF;">●</span> Pick-Up — 100%</li>
                    <li><span style="color:#1A8CFF;">●</span> Cek Masalah — 100%</li>
                    <li><span style="color:#3399FF;">●</span> Cari Oli — 100%</li>
                    <li><span style="color:#4DA6FF;">●</span> Ganti Oli — 100%</li>
                    <li><span style="color:#CFE8FF;">●</span> Drop-Off — 50%</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('progressDonutChart');

// Plugin untuk menampilkan teks tengah
const centerTextPlugin = {
    id: 'centerText',
    beforeDraw(chart) {
        const {width, height, ctx} = chart;
        ctx.restore();
        const fontSize = (width / 12).toFixed(2);
        ctx.font = `${fontSize}px sans-serif`;
        ctx.textBaseline = 'middle';
        ctx.textAlign = 'center';
        ctx.fillStyle = '#111';
        ctx.fillText('OTW Drop-Off', width / 2, height / 2);
        ctx.save();
    }
};

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Drop-Off', 'Pick-Up', 'Cek Masalah', 'Cari Oli', 'Ganti Oli'],
        datasets: [{
            data: [50, 100, 100, 100, 100],
            backgroundColor: ['#CFE8FF', '#007BFF', '#1A8CFF', '#3399FF', '#4DA6FF'],
            borderWidth: 4,
            borderRadius: 6,
            cutout: '75%'
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            tooltip: { enabled: false }
        }
    },
    plugins: [centerTextPlugin]
});
</script>
@endsection
