@extends('template.template_kepala-madrasah')

@section('content')

<!-- Content wrapper -->
 <div class="mt-4">
 <div class="row">
    <div class="col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 mb-2">
        <div class="card bg-success">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head fw-bold text-dark">Peserta Didik</p>
                        <h2 class="text-white">{{$jumlahPeserta}}</h2>
                    </div>
                    <i class="mdi mdi-account-multiple card-icon-indicator text-white" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 mb-2">
        <div class="card bg-primary">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head fw-bold text-dark">Guru</p>
                        <h2 class="text-white">{{$jumlahGuru}}</h2>
                    </div>
                    <i class="mdi mdi-account-multiple card-icon-indicator text-white" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
<div class="">
        <div class="col-md-12 stretch-card grid-margin mb-2">
            <div class="">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <h5 class="fw-bold text-dark">Statistik</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="flot-chart-wrapper">
                                    <div id="flotChart" class="flot-chart mx-4">
                                        <canvas id="combinedChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('combinedChart').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'Jumlah Peserta Masuk',
                        data: {!! json_encode($siswaValues) !!},
                        backgroundColor: '#71dd37',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        barThickness: 20,
                        fill: false
                    },
                    {
                        label: 'Jumlah Guru Masuk',
                        data: {!! json_encode($guruValues) !!},
                        backgroundColor: '#696cff',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        barThickness: 20,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 0 // Menghilangkan animasi untuk troubleshooting
                }
            }
        });
    });
</script>

@endsection
