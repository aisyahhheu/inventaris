<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            overflow-y: auto;
            z-index: 1000;
        }
        
        /* Gaya baru untuk header sidebar */
        .sidebar .sidebar-header-custom {
            display: flex;
            align-items: center; /* Menyusun logo dan teks secara vertikal di tengah */
            padding-bottom: 20px;
            border-bottom: 1px solid #3e495d;
            margin-bottom: 20px;
        }

        .sidebar .sidebar-header-custom .logo-container img {
            max-width: 70px;
            height: auto;
            object-fit: contain; 
            margin-right: 20px; /* Jarak antara logo dan teks */
        }
        
        .sidebar .sidebar-header-custom .admin-info h3 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .sidebar .sidebar-header-custom .admin-info p {
            margin: 0;
            font-size: 0.8rem;
            color: #b0c4de;
        }

        .sidebar .menu-header {
            color: #b0c4de;
            font-weight: 500;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            padding: 0 15px;
            margin-top: 20px;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .sidebar .menu-item {
            margin-bottom: 5px;
        }
        
        .sidebar .menu-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #b0c4de;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.9rem;
        }

        .sidebar .menu-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar .menu-link:hover, .sidebar .menu-link.active {
            background-color: #4a73df; /* Warna biru untuk menu aktif */
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
        
        .sidebar .dropdown-menu {
            list-style: none;
            padding: 0;
            margin-left: 25px;
            display: none;
        }

        .sidebar .menu-item.dropdown.show .dropdown-menu {
            display: block;
        }
        
        .sidebar .dropdown-toggle {
            cursor: pointer;
        }

        .sidebar .logout-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #dc3545;
            text-decoration: none;
            font-size: 0.9rem;
            border-radius: 8px;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .logout-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar .logout-link:hover {
            background-color: #1a2a44;
            color: #dc3545;
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
            
            /* CSS untuk membuat navbar fixed */
            position: fixed;
            top: 20px;
            left: 270px; /* 250px (sidebar) + 20px (padding) */
            right: 20px;
            z-index: 999;
        }
        
        /* Menambahkan padding pada main content agar tidak tertutup navbar fixed */
        .main-content-wrapper {
            padding-top: 80px; /* Sesuaikan tinggi navbar + margin */
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
        
        .top-navbar .menu-toggle {
            display: none;
            cursor: pointer;
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
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .info-card .card-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        
        .info-card .card-content .text-group {
            display: flex;
            flex-direction: column;
        }

        .info-card .icon-container {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .info-card .icon-container i {
            font-size: 1.5rem;
            color: #fff;
        }
        
        .info-card h3 {
            font-size: 2rem;
            margin: 0;
        }

        .info-card p {
            font-size: 1rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        .info-card .btn-detail {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            align-self: flex-start;
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
                left: -250px;
                transition: left 0.3s ease;
            }
            .sidebar.active {
                left: 0;
            }
            .main-container {
                margin-left: 0;
            }
            .top-navbar {
                left: 20px; /* Sesuaikan posisi navbar di mobile */
            }
            .top-navbar .welcome,
            .top-navbar .user-info {
                display: none;
            }
            .top-navbar .menu-toggle {
                display: block;
            }
            .top-navbar {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div> 
            <div class="sidebar-header-custom">
                <div class="logo-container">
                    <img src="{{ asset('lldikti-logo.png') }}" alt="LLDIKTI Logo">
                </div>
                <div class="admin-info">
                    <h3>Admin</h3>
                    <p>Panel</p>
                </div>
            </div>
            
            <div class="menu-header">Menu Utama</div>
            <ul class="menu">
                <li class="menu-item"><a href="#" class="menu-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                
                <li class="menu-item dropdown">
                    <a class="menu-link dropdown-toggle" data-bs-toggle="collapse" href="#inv-collapse" role="button" aria-expanded="false" aria-controls="inv-collapse">
                        <i class="fas fa-boxes"></i> Manajemen Inventaris
                    </a>
                    <ul class="dropdown-menu collapse" id="inv-collapse">
                        <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-sign-in-alt"></i> Barang Masuk</a></li>
                        <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-sign-out-alt"></i> Barang Keluar</a></li>
                        <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-database"></i> Data Aset</a></li>
                    </ul>
                </li>
                
                <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-handshake"></i> Peminjaman Aset</a></li>
                <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-tools"></i> Pemeliharaan Aset</a></li>
                <li class="menu-item"><a href="#" class="menu-link"><i class="fas fa-file-alt"></i> Laporan</a></li>
                
                <li class="menu-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-link">
                            <i class="fas fa-sign-out-alt"></i> Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-container">
        <div class="top-navbar">
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="welcome d-none d-md-block">Selamat Datang, Admin!</div>
            <div class="user-info d-none d-md-block">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                <i class="fas fa-user-circle ms-2" style="font-size: 1.5rem; color: #007bff;"></i>
            </div>
        </div>

        <div class="main-content-wrapper">
            <div class="card-container">
                <div class="info-card blue">
                    <div class="card-content">
                        <div class="text-group">
                            <h3>100</h3>
                            <p>Jumlah Aset</p>
                        </div>
                        <div class="icon-container"><i class="fas fa-box"></i></div>
                    </div>
                    <a href="#" class="btn-detail">Lihat Detail</a>
                </div>
                <div class="info-card yellow">
                    <div class="card-content">
                        <div class="text-group">
                            <h3>17</h3>
                            <p>Status Peminjaman</p>
                        </div>
                        <div class="icon-container"><i class="fas fa-clipboard-list"></i></div>
                    </div>
                    <a href="#" class="btn-detail">Lihat Detail</a>
                </div>
                <div class="info-card green">
                    <div class="card-content">
                        <div class="text-group">
                            <h3>20</h3>
                            <p>Pemeliharaan Aset</p>
                        </div>
                        <div class="icon-container"><i class="fas fa-wrench"></i></div>
                    </div>
                    <a href="#" class="btn-detail">Catatan Perawatan</a>
                </div>
                <div class="info-card purple">
                    <div class="card-content">
                        <div class="text-group">
                            <h3>2</h3>
                            <p>Laporan Terbaru</p>
                        </div>
                        <div class="icon-container"><i class="fas fa-chart-line"></i></div>
                    </div>
                    <a href="#" class="btn-detail">Lihat Laporan</a>
                </div>
            </div>

            <div class="content-section">
                <h4>Grafik Transaksi</h4>
                <canvas id="myChart"></canvas>
            </div>

            <div class="content-section">
                <h4>Aktivitas Terbaru</h4>
                <div class="table-responsive">
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
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Barang Masuk',
                    data: [12, 19, 3, 5, 2, 3, 7, 10, 15, 8, 11, 14],
                    backgroundColor: '#4a73df',
                    borderWidth: 1
                },
                {
                    label: 'Barang Keluar',
                    data: [5, 7, 4, 8, 6, 5, 9, 12, 10, 6, 9, 11],
                    backgroundColor: '#1cc88a',
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

        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }
    </script>
</body>
</html>