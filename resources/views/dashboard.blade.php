@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 12px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: none;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 0.8rem;
            letter-spacing: 0.05rem;
        }
        .card-text {
            font-size: 2.5rem;
        }
        .btn-outline-light {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.7);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            padding: 8px 24px;
            border-radius: 50rem;
            transition: all 0.3s ease;
        }
        .btn-outline-light:hover {
            background-color: #fff;
            color: #4a73df;
        }
        .badge {
            font-weight: 600;
            padding: 0.5em 0.75em;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.03);
        }
        .table thead th {
            border-bottom: 2px solid #e9ecef;
        }
    </style>

    <div class="container-fluid">
        <div class="row g-4 mb-4">
            <!-- Card 1: Jumlah Aset -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-white shadow-sm h-100" style="background-color: #4a73df;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="card-title text-uppercase mb-0">JUMLAH ASET</h5>
                                <h3 class="card-text fw-bold mt-1">100</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-boxes text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-light mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Status Peminjaman -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-white shadow-sm h-100" style="background-color: #f7a637;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="card-title text-uppercase mb-0">STATUS PEMINJAMAN</h5>
                                <h3 class="card-text fw-bold mt-1">17</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clipboard-check text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-light mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Pemeliharaan Aset -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-white shadow-sm h-100" style="background-color: #1cc88a;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="card-title text-uppercase mb-0">PEMELIHARAAN ASET</h5>
                                <h3 class="card-text fw-bold mt-1">20</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tools text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-light mt-auto">Catatan Perawatan</a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Laporan Terbaru -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-white shadow-sm h-100" style="background-color: #9b59b6;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="card-title text-uppercase mb-0">LAPORAN TERBARU</h5>
                                <h3 class="card-text fw-bold mt-1">2</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-file-alt text-white" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-light mt-auto">Lihat Laporan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Transaksi Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <h4 class="card-title fw-bold mb-4">Grafik Transaksi</h4>
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <!-- Aktivitas Terbaru Section -->
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h4 class="card-title fw-bold mb-4">Aktivitas Terbaru</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Kategori Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>26/09/2025</td>
                                <td><span class="badge bg-success">Masuk</span></td>
                                <td>BR-1001</td>
                                <td>Proyektor</td>
                                <td>3</td>
                                <td>Elektronik</td>
                            </tr>
                            <tr>
                                <td>26/09/2025</td>
                                <td><span class="badge bg-danger">Keluar</span></td>
                                <td>BR-1002</td>
                                <td>Kertas HVS</td>
                                <td>15</td>
                                <td>ATK</td>
                            </tr>
                            <tr>
                                <td>25/09/2025</td>
                                <td><span class="badge bg-success">Masuk</span></td>
                                <td>BR-1003</td>
                                <td>Laptop</td>
                                <td>4</td>
                                <td>Elektronik</td>
                            </tr>
                            <tr>
                                <td>25/09/2025</td>
                                <td><span class="badge bg-danger">Keluar</span></td>
                                <td>BR-1004</td>
                                <td>Mouse</td>
                                <td>2</td>
                                <td>Elektronik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Barang Masuk',
                        data: [12, 19, 3, 5, 2, 3, 7, 10, 15, 8, 11, 14],
                        backgroundColor: '#4a73df',
                        borderWidth: 1,
                        borderRadius: 5,
                    }, {
                        label: 'Barang Keluar',
                        data: [5, 7, 4, 8, 6, 5, 9, 12, 10, 6, 9, 11],
                        backgroundColor: '#1cc88a',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
