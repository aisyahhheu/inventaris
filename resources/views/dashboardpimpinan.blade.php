@extends('layouts.pimpinan')

@section('title', 'Dashboard Pimpinan')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    
    {{-- Chart.js untuk Grafik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- === STYLE CSS MURNI DENGAN SKEMA BIRU (INTERNAL) === --}}
    <style>
        /* === Definisi Skema Warna Biru === */
        :root {
            --color-blue-dark: #2c5d86;    /* Biru Paling Gelap - Kartu Utama */
            --color-blue-deep: #324A5F;    /* Biru Gelap Kedua - Item Aset */
            --color-blue-medium: #5880a3;  /* Biru Sedang - Tombol, Highlight */
            --color-blue-light: #709CC0;   /* Biru Muda - Header Tabel */
            --color-blue-soft: #AFC6D8;    /* Biru Sangat Muda - Latar Belakang Bagian Informasi */
            --color-blue-bg: #e0f2fe;      /* Biru Paling Cerah/Latar Belakang Body */
            --color-text-white: #ffffff;
            --color-text-dark: #1f2937;    /* Biru Tua/Hampir Hitam untuk teks */
            --shadow-light: 0 4px 6px rgba(44, 93, 134, 0.15); /* Bayangan Biru Tipis */
        }

        /* === Dasar Global === */
        body {
            background-color: var(--color-blue-bg); /* Latar belakang body biru cerah */
            font-family: 'Arial', sans-serif;
            color: var(--color-text-dark);
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        a {
            text-decoration: none;
            color: var(--color-text-white);
        }

        .dashboard-container {
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* === Kartu Umum (Card) === */
        .card {
            background-color: var(--color-text-white);
            padding: 1.5rem;
            border-radius: 1.5rem; /* Lebih membulat untuk kesan lucu/modern */
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(44, 93, 134, 0.3);
            transform: translateY(-2px);
        }


        /* --- Kartu Statistik Utama --- */
        .stats-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background-color: var(--color-blue-dark);
            color: var(--color-text-white);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
        }

        .card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-grow: 1;
            margin-bottom: 1rem;
        }

        .card-text h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-top: 0;
        }

        .icon-placeholder {
            height: 3rem;
            width: 3rem;
            border-radius: 0.75rem;
            background-color: var(--color-blue-medium); /* Biru Sedang */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* Tombol Detail */
        .detail-link {
            text-align: center;
            background-color: var(--color-blue-medium);
            border-radius: 0.75rem;
            padding: 0.5rem;
            font-size: 0.875rem;
            transition: opacity 0.3s;
        }

        .detail-link:hover {
            opacity: 0.9;
            background-color: var(--color-blue-deep);
        }

        /* --- Informasi Aset & Grafik --- */
        .info-chart-layout {
            display: grid;
            grid-template-columns: 1fr; 
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .info-chart-layout {
                grid-template-columns: 2fr 1fr; /* Skema 2:1 */
            }
        }

        .asset-info-card {
            background-color: var(--color-blue-soft); /* Latar belakang biru muda */
            color: var(--color-text-dark);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-header h2 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        /* Search Input */
        .search-box {
            position: relative;
        }

        .search-box input {
            border: 1px solid var(--color-blue-medium);
            border-radius: 9999px; 
            padding: 0.25rem 1rem 0.25rem 2rem;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.3s;
        }
        
        .search-icon {
            width: 1rem;
            height: 1rem;
            color: var(--color-blue-medium);
            position: absolute;
            left: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Carousel Aset */
        .asset-carousel {
            display: flex;
            align-items: center;
            overflow: hidden;
            padding: 0.5rem 0; 
        }

        .asset-cards-wrapper {
            display: flex;
            flex: 1;
            gap: 1rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: 10px; 
        }

        .asset-item-card {
            background-color: var(--color-blue-deep);
            color: var(--color-text-white);
            border-radius: 1rem;
            padding: 1rem;
            text-align: center;
            flex: 0 0 200px; 
            scroll-snap-align: start;
            box-shadow: var(--shadow-light);
        }

        .asset-image-box {
            height: 6rem;
            background-color: var(--color-text-white); 
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .asset-stats {
            text-align: left;
            font-size: 0.875rem;
            line-height: 1.4;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .carousel-btn {
            background: var(--color-blue-medium);
            color: var(--color-text-white);
            border: none;
            padding: 0.5rem 0.75rem;
            margin: 0 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.5rem;
            line-height: 1;
            box-shadow: var(--shadow-light);
        }

        /* --- Grafik Pengajuan --- */
        .chart-card {
            display: flex;
            flex-direction: column;
        }

        .chart-area {
            flex-grow: 1;
            min-height: 250px; 
            padding-bottom: 1rem;
        }

        .more-info-btn {
            margin-top: 0.75rem;
            color: var(--color-blue-dark);
            cursor: pointer;
            border: none;
            background: none;
            text-align: left;
            font-size: 0.875rem;
        }


        /* --- Aktivitas Terbaru (Tabel) --- */
        .recent-activity-card {
            padding: 0;
            overflow: hidden;
        }

        .activity-header {
            text-align: center;
            background-color: var(--color-blue-light);
            color: var(--color-text-white);
            padding: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .table-wrapper {
            overflow-x: auto;
            padding: 1.5rem;
        }

        .activity-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.875rem;
            min-width: 600px; 
        }

        .activity-table thead tr {
            background-color: var(--color-blue-soft);
            color: var(--color-text-dark);
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .activity-table th, .activity-table td {
            padding: 0.75rem 1rem;
            text-align: left;
        }

        .activity-table tbody tr:hover {
            background-color: var(--color-blue-bg);
        }

        /* Badge untuk tipe aktivitas */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-masuk {
            background-color: rgba(94, 150, 207, 0.2); 
            color: var(--color-blue-dark);
        }

        .badge-keluar {
            background-color: rgba(44, 93, 134, 0.2); 
            color: var(--color-blue-deep);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        {{-- === Kartu Statistik Utama === --}}
        <div class="stats-cards-grid">
            {{-- Jumlah Aset --}}
            <div class="card stat-card">
                <div class="card-content">
                    <div class="card-text">
                        <h3>Jumlah Aset</h3>
                        <p class="stat-number">{{ $jumlah_aset }}</p>
                    </div>
                    {{-- Ganti icon dengan emoji biru --}}
                    <div class="icon-placeholder">📈</div> 
                </div>
                <a href="#" class="detail-link">Lihat Detail</a>
            </div>

            {{-- Peminjaman --}}
            <div class="card stat-card">
                <div class="card-content">
                    <div class="card-text">
                        <h3>Peminjaman</h3>
                        <p class="stat-number">60</p>
                    </div>
                    <div class="icon-placeholder">🤝</div> 
                </div>
                <a href="{{ route('peminjamanpimpinan') }}" class="detail-link">Lihat Detail</a>
            </div>

            {{-- Maintenance --}}
            <div class="card stat-card">
                <div class="card-content">
                    <div class="card-text">
                        <h3>Maintenance</h3>
                        <p class="stat-number">100</p>
                    </div>
                    <div class="icon-placeholder">🛠️</div>
                </div>
                <a href="{{ route('perbaikanpimpinan') }}" class="detail-link">Lihat Detail</a>
            </div>

            {{-- Pengajuan Baru --}}
            <div class="card stat-card">
                <div class="card-content">
                    <div class="card-text">
                        <h3>Pengajuan Baru</h3>
                        <p class="stat-number">36</p>
                    </div>
                    <div class="icon-placeholder">🆕</div>
                </div>
                <a href="#" class="detail-link">Lihat Detail</a>
            </div>
        </div>

        {{-- === Informasi Aset & Grafik === --}}
        <div class="info-chart-layout">
            {{-- Informasi Aset --}}
            <div class="card asset-info-card">
                <div class="card-header">
                    <h2>Informasi Aset</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Cari aset...">
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="asset-carousel">
                    <button class="carousel-btn">&lt;</button>
                    <div class="asset-cards-wrapper">
                        {{-- Contoh Item Aset 1 --}}
                        <div class="asset-item-card">
                            <h3>Nama Barang</h3>
                            <div class="asset-image-box"></div>
                            <div class="asset-stats">
                                <p>Tersedia: <span class="stat-highlight">-</span></p>
                                <p>Masuk: <span class="stat-highlight">-</span></p>
                                <p>Keluar: <span class="stat-highlight">-</span></p>
                            </div>
                        </div>

                        {{-- Contoh Item Aset 2 --}}
                        <div class="asset-item-card">
                            <h3>Nama Barang</h3>
                            <div class="asset-image-box"></div>
                            <div class="asset-stats">
                                <p>Tersedia: <span class="stat-highlight">-</span></p>
                                <p>Masuk: <span class="stat-highlight">-</span></p>
                                <p>Keluar: <span class="stat-highlight">-</span></p>
                            </div>
                        </div>

                        {{-- Contoh Item Aset 3 --}}
                        <div class="asset-item-card">
                            <h3>Nama Barang</h3>
                            <div class="asset-image-box"></div>
                            <div class="asset-stats">
                                <p>Tersedia: <span class="stat-highlight">-</span></p>
                                <p>Masuk: <span class="stat-highlight">-</span></p>
                                <p>Keluar: <span class="stat-highlight">-</span></p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-btn">&gt;</button>
                </div>
            </div>

            {{-- Grafik Pengajuan --}}
            <div class="card chart-card">
                <h2>Grafik Pengajuan</h2>
                <div class="chart-area">
                    <canvas id="chart"></canvas>
                </div>
                <button class="more-info-btn">Lihat selengkapnya</button>
            </div>
        </div>

        {{-- === Aktivitas Terbaru === --}}
        <div class="card recent-activity-card">
            <h2 class="activity-header">Aktivitas Terbaru</h2>
            <div class="table-wrapper">
                <table class="activity-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Gudang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latest_aset as $data)
                        <tr>
                            <td>{{ $data->tanggal }}</td>
                            <td>
                                @if ($data->masuk > 0)
                                    <span class="badge badge-masuk">Masuk</span>
                                @else
                                    <span class="badge badge-keluar">Keluar</span>
                                @endif
                            </td>
                            <td>BR-{{ $data->id }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->gudang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- === Chart JS Script === --}}
    <script>
        const ctx = document.getElementById('chart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [
                    { 
                        label: 'Peminjaman', 
                        data: [8, 5, 9, 6, 4, 7], 
                        backgroundColor: 'var(--color-blue-medium)', 
                        borderRadius: 8 // Sentuhan modern
                    },
                    { 
                        label: 'Perbaikan', 
                        data: [4, 2, 5, 3, 1, 2], 
                        backgroundColor: 'var(--color-blue-dark)', 
                        borderRadius: 8 
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: true, position: 'bottom' }
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        beginAtZero: true, 
                        grid: { color: 'rgba(175, 198, 216, 0.5)' }, // Garis grid biru muda
                        ticks: { stepSize: 2 } 
                    }
                }
            }
        });
    </script>
</body>
</html>
@endsection