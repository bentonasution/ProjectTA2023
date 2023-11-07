@extends('layouts.app')

@section('contents')

<h3 class="font-weight-bold mb-4 ml-3 text-gray-800">Dashboard</h3>


<div class="row">
    <div class="col-8">
        <div class="col-xl-10 col-md-10 mb-4 mt-4">
            <div class="card shadow h-100 py-2" style="background-color: #970C10;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Buku</div>
                            <span class="h5 mb-0 font-weight-bold text-white">{{ $jumlahbuku }}</span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-open fa-2x text-white"></i> <!-- Ubah warna ikon menjadi putih -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->check() && (auth()->user()->role === 'admin'))
        <div class="col-xl-10 col-md-10 mb-4 mt-4">
            <div class="card shadow h-100 py-2" style="background-color: #013A20;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Pengguna</div>
                            <span class="h5 mb-0 font-weight-bold text-white">{{ $jumlahpengguna }}</span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-white"></i> <!-- Ubah warna ikon menjadi putih -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas'))
        <div class="col-xl-10 col-md-10 mb-4 mt-4">
            <div class="card shadow h-100 py-2" style="background-color: #CBAE11;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Transaksi</div>
                            <span class="h5 mb-0 font-weight-bold text-white">{{ $jumlahtransaksi }}</span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-area fa-2x text-white"></i> <!-- Ubah warna ikon menjadi putih -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(auth()->check() && auth()->user()->role === 'user')
        <div class="col-xl-10 col-md-10 mb-4 mt-4">
            <div class="card shadow h-100 py-2" style="background-color: #013A20;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Kategori Buku</div>
                            <span class="h5 mb-0 font-weight-bold text-white">{{ $jumlahkategori }}</span>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-book-reader fa-2x text-white"></i> <!-- Ubah warna ikon menjadi putih -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="col-lg-4 col-md-12">
            <!-- Konten kolom kanan di sini -->
            <div class="card shadow mb-4 border-bottom-info bg-gray-200">
                <div class="card-header py-3  border-bottom-info">
                    <h6 class="m-0 font-weight-bold text-info" style="font-size: 20px; color: #3498db;">Grafik</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

@if(auth()->check() && (auth()->user()->role === 'admin'))
<script>
    var jumlahBuku = ('{{$jumlahbuku}}');
    var jumlahPengguna = ('{{$jumlahpengguna}}');
    var jumlahTransaksi = ('{{$jumlahtransaksi}}');

    var donutChartCanvas = document.getElementById('donutChart').getContext('2d');

    var donutData = {
        labels: ['Buku', 'Pengguna', 'Transaksi'],
        datasets: [{
            data: [jumlahBuku, jumlahPengguna, jumlahTransaksi],
            backgroundColor: ['#970C10', '#013A20', '#CBAE11'], // Merah, biru, kuning
            hoverBackgroundColor: ['#970C10', '#013A20', '#CBAE11']
        }]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true // Menggunakan icon point style
                }
            }
        }
    };

    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });
</script>
@endif
@if(auth()->check() && (auth()->user()->role === 'petugas'))
<script>
    var jumlahBuku = ('{{$jumlahbuku}}');
    var jumlahTransaksi = ('{{$jumlahtransaksi}}');

    var donutChartCanvas = document.getElementById('donutChart').getContext('2d');

    var donutData = {
        labels: ['Buku', 'Transaksi'],
        datasets: [{
            data: [jumlahBuku, jumlahTransaksi],
            backgroundColor: ['#970C10', '#CBAE11'], // Merah, biru, kuning
            hoverBackgroundColor: ['#970C10', '#CBAE11']
        }]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true // Menggunakan icon point style
                }
            }
        }
    };

    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });
</script>
@endif
@if(auth()->check() && auth()->user()->role === 'user')
<script>
    var jumlahBuku = ('{{$jumlahbuku}}');
    var jumlahKategori = ('{{$jumlahkategori}}');

    var donutChartCanvas = document.getElementById('donutChart').getContext('2d');

    var donutData = {
        labels: ['Buku', 'Kategori'],
        datasets: [{
            data: [jumlahBuku, jumlahKategori],
            backgroundColor: ['#970C10', '#013A20'], // Merah, biru, kuning
            hoverBackgroundColor: ['#970C10', '#013A20']
        }]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true // Menggunakan icon point style
                }
            }
        }
    };

    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    });
</script>
@endif
@endsection