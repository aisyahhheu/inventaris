<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: 250px;
            background-color: #0d1e37;
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .logo-container img {
            max-width: 100%;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .sidebar .menu-item {
            margin-bottom: 5px; /* Mengurangi spasi antar item */
        }
        
        .sidebar .menu-link {
            display: block;
            padding: 10px 15px; /* Mengurangi padding untuk mengecilkan tulisan */
            color: #b0c4de;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.9rem; /* Mengecilkan ukuran font */
        }

        .sidebar .menu-link:hover, .sidebar .menu-link.active {
            background-color: #1a2a44;
            color: #fff;
            font-weight: 600;
        }

        .sidebar .menu-link.active::before {
            content: '';
            display: inline-block;
            width: 5px;
            height: 100%;
            background-color: #007bff;
            border-radius: 3px;
            margin-right: 10px;
            vertical-align: middle;
        }

        /* --- Main Content Area --- */
        .main-container {
            flex-grow: 1;
            margin-left: 250px;
            padding: 20px;
        }

        /* --- Top Navbar --- */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .top-navbar .welcome {
            font-weight: 600;
            color: #333;
        }

        .top-navbar .user-info a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        /* --- Cards Section --- */
        .card-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .info-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            color: white;
            flex: 1;
            min-width: 200px;
        }

        .info-card h3 {
            font-size: 2rem;
            margin: 0;
        }

        .info-card p {
            font-size: 1rem;
            opacity: 0.8;
        }

        .info-card .btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            margin-top: 10px;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .info-card.blue { background-color: #4a73df; }
        .info-card.yellow { background-color: #f6c23e; }
        .info-card.green { background-color: #1cc88a; }
        .info-card.purple { background-color: #a55bff; }
        
        /* --- Chart and Table Sections --- */
        .content-section {
            background-color: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .content-section h4 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
            }
            .main-container {
                margin-left: 0;
            }
            .top-navbar {
                left: 0;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="{{ asset('path/to/lldikti-logo.png') }}" alt="LLDIKTI Logo">
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="#" class="menu-link active">Dashboard</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Manajemen Inventaris</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Barang Masuk</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Barang Keluar</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Data Aset</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Peminjaman Aset</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Pemeliharaan Aset</a></li>
                <li class="menu-item"><a href="#" class="menu-link">Laporan</a></li>
            </ul>
        </div>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-link">Log out</button>
            </form>
        </div>
    </div>

    <div class="main-container">
        <div class="top-navbar">
            <div class="welcome">Selamat Datang, Admin!</div>
            <div class="user-info">
                <a href="#">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="card-container">
            <div class="info-card blue">
                <h3>100</h3>
                <p>Jumlah Aset</p>
                <a href="#" class="btn btn-outline-light">Lihat Detail</a>
            </div>
            <div class="info-card yellow">
                <h3>17</h3>
                <p>Status Peminjaman</p>
                <a href="#" class="btn btn-outline-light">Lihat Detail</a>
            </div>
            <div class="info-card green">
                <h3>20</h3>
                <p>Pemeliharaan Aset</p>
                <a href="#" class="btn btn-outline-light">Catatan Perawatan</a>
            </div>
            <div class="info-card purple">
                <h3>2</h3>
                <p>Laporan Terbaru</p>
                <a href="#" class="btn btn-outline-light">Lihat Laporan</a>
            </div>
        </div>

        <div class="content-section">
            <h4>Grafik Transaksi</h4>
            <canvas id="myChart"></canvas>
        </div>

        <div class="content-section">
            <h4>Aktivitas Terbaru</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Kategori Barang</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2025-09-03</td>
                        <td><span class="badge bg-success">Masuk</span></td>
                        <td>BR-10001</td>
                        <td>Proyektor</td>
                        <td>3</td>
                        <td>Elektronik</td>
                    </tr>
                    <tr>
                        <td>2025-09-03</td>
                        <td><span class="badge bg-danger">Keluar</span></td>
                        <td>BR-10001</td>
                        <td>Proyektor</td>
                        <td>1</td>
                        <td>Elektronik</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Barang Masuk',
                    data: [12, 19, 3, 5, 2, 3, 7, 10, 15, 8, 11, 14],
                    backgroundColor: '#4a73df', // Warna biru
                    borderWidth: 1
                },
                {
                    label: 'Barang Keluar',
                    data: [5, 7, 4, 8, 6, 5, 9, 12, 10, 6, 9, 11],
                    backgroundColor: '#1cc88a', // Warna hijau
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>