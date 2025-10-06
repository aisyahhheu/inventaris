<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'App')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary-blue: #3498db;
            --primary-orange: #f39c12;
            --primary-green: #2ecc71;
            --primary-purple: #9b59b6;
            --bg-light: #ecf0f1;
            --text-dark: #2c3e50;
            --border-light: #bdc3c7;
            --sidebar-bg: #2c3e50;
            --card-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        /* Logo and Hamburger */
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo {
            opacity: 1;
            pointer-events: auto;
            justify-content: center;
        }

        .sidebar.collapsed .logo a {
            display: none;
        }

        .sidebar.collapsed .hamburger-sidebar {
            opacity: 1;
            pointer-events: auto;
        }

        .hamburger-sidebar {
            background: none;
            border: none;
            color: var(--text-dark);
            font-size: 1.5em;
            cursor: pointer;
            margin-right: 15px;
            display: none;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .hamburger-sidebar:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 120px;
            height: auto;
            border-radius: 10px;
            margin-right: 10px;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed .logo img {
            width: 60px;
            height: auto;
        }

        .logo-text {
            display: none;
        }

        .menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .menu {
            opacity: 0;
            pointer-events: none;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .menu-item {
            padding: 10px 15px;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            font-weight: 500;
        }

        /* Submenu Styling */
        .submenu {
            list-style: none;
            padding-left: 30px;
            margin-top: -5px;
            display: none;
        }

        .submenu.active {
            display: block;
        }

        .submenu li a {
            padding: 5px 0;
        }

        .logout {
            margin-top: auto;
        }

        .logout a {
            color: #e74c3c;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout a:hover {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        /* Main Content Styling */
        .main-content {
            flex-grow: 1;
            padding: 0;
        }

        /* Top Bar Styling */
        .top-bar {
            background-color: #e1f5fe;
            color: var(--text-dark);
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            height: 80px;
        }

        .hamburger {
            background: none;
            border: none;
            color: var(--text-dark);
            font-size: 1.5em;
            cursor: pointer;
            margin-right: 15px;
            display: none;
        }

        .top-bar-title {
            font-size: 1.5em;
            font-weight: 600;
        }

        .content-area {
            padding: 30px;
            background-color: var(--bg-light);
        }

        .header {
            display: none;
        }

        /* Form Styling */
        .form-card {
            background: white;
            border-radius: 25px;
            padding: 60px 70px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            color: var(--text-dark);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .form-card:hover {
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
            transform: translateY(-5px);
        }

        .form-header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            margin: -40px -40px 30px -40px;
            text-align: center;
            font-weight: 600;
            font-size: 1.2em;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1em;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            grid-column: span 2;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 700;
            color: white;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .btn-blue { background: linear-gradient(45deg, var(--sidebar-bg), #1f2d3a); }
        .btn-blue:hover { background: linear-gradient(45deg, #1f2d3a, #0f1419); transform: translateY(-3px) scale(1.05); }

        .btn-grey { background-color: #95a5a6; }
        .btn-grey:hover { background-color: #7f8c8d; transform: translateY(-3px) scale(1.05); }

        .btn-red { background-color: #c0392b; }
        .btn-red:hover { background-color: #922b21; transform: translateY(-3px) scale(1.05); }

        /* Card Styling for Dashboard */
        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15), 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 180px;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
        }

        .card::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 0;
        }

        .card h3, .btn-ajukan, .btn-detail {
            position: relative;
            z-index: 1;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card.blue-card { background: linear-gradient(135deg, #3498db, #2980b9); }
        .card.orange-card { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .card.green-card { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .card.purple-card { background: linear-gradient(135deg, #9b59b6, #8e44ad); }

        .card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .btn-ajukan, .btn-detail {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.6));
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1em;
            transition: all 0.3s ease;
            margin: 0 auto;
            display: block;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-ajukan:hover, .btn-detail:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.8));
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px) scale(1.05);
        }

        .icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 3em;
            color: rgba(255, 255, 255, 0.2);
            transform: rotate(15deg);
        }

        /* Statistik Styling */
        .section-title {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .statistic-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-light);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 2.5em;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
        }

        .stat-card:nth-child(2) .stat-number { color: var(--primary-orange); }
        .stat-card:nth-child(3) .stat-number { color: var(--primary-green); }
        .stat-card:nth-child(4) .stat-number { color: var(--primary-purple); }

        .stat-text {
            font-size: 0.9em;
            color: #7f8c8d;
        }

        /* Table Styling for Laporan */
        .tab-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 20px;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid var(--border-light);
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-dark);
            border-radius: 10px 10px 0 0;
            background: var(--bg-light);
            margin-right: 10px;
            user-select: none;
            transition: background-color 0.3s;
        }

        .tab.active {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 -3px 5px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            table-layout: auto;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid var(--border-light);
        }

        th, td {
            padding: 8px 10px;
            border: 1px solid var(--border-light);
            text-align: center;
            vertical-align: middle;
            line-height: 1.4;
            word-break: break-word;
            hyphens: auto;
            white-space: normal;
        }

        /* Headers and cells centered */
        th {
            white-space: nowrap;
        }

        /* Perbaikan table columns (7 cols) */
        #table-perbaikan th:nth-child(1), #table-perbaikan td:nth-child(1) { width: 12%; } /* Date */
        #table-perbaikan th:nth-child(2), #table-perbaikan td:nth-child(2) { width: 15%; } /* Nama Barang */
        #table-perbaikan th:nth-child(3), #table-perbaikan td:nth-child(3) { width: 10%; } /* Kode Barang */
        #table-perbaikan th:nth-child(4), #table-perbaikan td:nth-child(4) { width: 12%; } /* Jenis Barang */
        #table-perbaikan th:nth-child(5), #table-perbaikan td:nth-child(5) { width: 15%; } /* Jenis Kerusakan */
        #table-perbaikan th:nth-child(6), #table-perbaikan td:nth-child(6) { width: 25%; } /* Keterangan Tambahan */
        #table-perbaikan th:nth-child(7), #table-perbaikan td:nth-child(7) { width: 11%; } /* Status */

        /* Pembelian table columns (6 cols) */
        #table-pembelian th:nth-child(1), #table-pembelian td:nth-child(1) { width: 15%; } /* Date */
        #table-pembelian th:nth-child(2), #table-pembelian td:nth-child(2) { width: 20%; } /* Nama Sparepart */
        #table-pembelian th:nth-child(3), #table-pembelian td:nth-child(3) { width: 15%; } /* Kode Barang Terkait */
        #table-pembelian th:nth-child(4), #table-pembelian td:nth-child(4) { width: 10%; } /* Jumlah */
        #table-pembelian th:nth-child(5), #table-pembelian td:nth-child(5) { width: 25%; } /* Alasan Pengajuan */
        #table-pembelian th:nth-child(6), #table-pembelian td:nth-child(6) { width: 15%; } /* Status */

        /* Peminjaman table columns (8 cols) - adjusted to match text lengths */
        #table-peminjaman th:nth-child(1), #table-peminjaman td:nth-child(1) { width: 12%; } /* Nama Pegawai */
        #table-peminjaman th:nth-child(2), #table-peminjaman td:nth-child(2) { width: 8%; } /* Tim Kerja */
        #table-peminjaman th:nth-child(3), #table-peminjaman td:nth-child(3) { width: 25%; } /* Tujuan Peminjaman */
        #table-peminjaman th:nth-child(4), #table-peminjaman td:nth-child(4) { width: 20%; } /* Barang Dipinjam */
        #table-peminjaman th:nth-child(5), #table-peminjaman td:nth-child(5) { width: 5%; } /* Jumlah */
        #table-peminjaman th:nth-child(6), #table-peminjaman td:nth-child(6) { width: 10%; } /* Tanggal Pinjam */
        #table-peminjaman th:nth-child(7), #table-peminjaman td:nth-child(7) { width: 10%; } /* Tanggal Kembali */
        #table-peminjaman th:nth-child(8), #table-peminjaman td:nth-child(8) { width: 10%; } /* Status */

        tr:nth-child(odd) {
            background-color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Specific adjustments for Jumlah column to center text */
        .jumlah-col th,
        .jumlah-col td {
            text-align: center !important;
            vertical-align: middle;
            white-space: nowrap;
        }

        th {
            background-color: var(--primary-blue);
            color: white;
            font-weight: 600;
        }

        .date-col th,
        .date-col td {
            text-align: center !important;
            white-space: nowrap;
        }

        .status-col {
            text-align: center !important;
            font-weight: bold;
            white-space: nowrap;
        }



        tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .status-approved,
        .status-disetujui {
            color: green;
            font-weight: 600;
        }

        .status-dipending {
            color: orange;
            font-weight: 600;
        }

        .status-ditolak {
            color: red;
            font-weight: 600;
        }

        .btn-detail {
            background-color: green;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            width: 100%;
        }

        .btn-detail:hover {
            background-color: darkgreen;
        }

        /* Media Queries */
        @media (max-width: 1200px) {
            .card-container, .statistic-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                padding: 15px;
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1000;
                background-color: var(--sidebar-bg);
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }
            .sidebar.active {
                display: flex;
            }
            .hamburger-sidebar {
                display: block;
            }
            .main-content {
                padding: 20px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-buttons {
                flex-direction: column;
                align-items: stretch;
            }
            .form-buttons .btn {
                width: 100%;
            }
            .card-container, .statistic-container {
                grid-template-columns: 1fr;
            }
            .tabs {
                flex-wrap: wrap;
            }
            .tab {
                margin-bottom: 10px;
            }

            th, td {
                padding: 8px 10px;
                font-size: 1em;
                white-space: normal;
                word-break: break-word;
                hyphens: auto;
                vertical-align: middle;
                border: 1px solid var(--border-light);
            }

            th {
                word-break: normal;
                white-space: nowrap;
                text-align: center;
            }

            .jumlah-col th,
            .jumlah-col td,
            .date-col th,
            .date-col td,
            .status-col th,
            .status-col td {
                white-space: nowrap;
            }

            /* Mobile: Force horizontal scrolling by setting min-width on tables */
            table {
                min-width: 800px;
            }

            /* Mobile Jumlah adjustments */
            .jumlah-col th, .jumlah-col td {
                text-align: center !important;
            }

            .tab-container {
                padding: 10px;
            }
        }

        /* Success Alert Styling */
        .alert-success {
            margin: 20px;
            padding: 15px 20px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.3s ease-out;
        }

        .alert-success i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .alert-success .close {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #155724;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .alert-success .close:hover {
            opacity: 1;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .alert-success {
                margin: 10px;
                padding: 12px 15px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div class="logo" id="logo">
                <a href="{{ route('dashboard.pegawai') }}">
                    <img src="{{ asset('lldikti logo.png') }}" alt="LLDIKTI Logo" />
                </a>
            </div>
            <ul class="menu">
                <li><a href="{{ route('dashboard.pegawai') }}"><i class="fas fa-home"></i> Dashboard Pegawai</a></li>
                <li class="menu-item" id="pemeliharaan-menu">
                    <i class="fas fa-tools"></i> Pemeliharaan
                </li>
                <ul class="submenu" id="pemeliharaan-submenu">
                    <li><a href="{{ route('form.perbaikan') }}"><i class="fas fa-wrench"></i> Perbaikan</a></li>
                    <li><a href="{{ route('form.pembelian.sparepart') }}"><i class="fas fa-shopping-cart"></i> Pembelian Sparepart</a></li>
                </ul>
                <li><a href="{{ route('form.peminjaman') }}"><i class="fas fa-hand-holding"></i> Peminjaman</a></li>
                <li><a href="{{ route('halaman.laporan') }}"><i class="fas fa-file-alt"></i> Laporan Saya</a></li>
                <li class="logout"><a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="top-bar">
                <button class="hamburger-sidebar" id="hamburger-sidebar" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="top-bar-title">@yield('page-title')</span>
            </div>
            @if (session('success'))
            <div class="alert-success">
                <span><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
                <button type="button" class="close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
            @endif
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pemeliharaanMenu = document.getElementById('pemeliharaan-menu');
            const pemeliharaanSubmenu = document.getElementById('pemeliharaan-submenu');

            pemeliharaanMenu.addEventListener('click', function() {
                pemeliharaanSubmenu.classList.toggle('active');
            });

            const hamburgerSidebar = document.getElementById('hamburger-sidebar');
            const sidebar = document.getElementById('sidebar');
            const logo = document.getElementById('logo');

            hamburgerSidebar.addEventListener('click', function(event) {
                event.stopPropagation();
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('active');
                } else {
                    sidebar.classList.toggle('collapsed');
                    // Adjust logo visibility when sidebar collapsed
                    if (sidebar.classList.contains('collapsed')) {
                        logo.querySelector('a').style.display = 'none';
                        logo.style.justifyContent = 'center';
                    } else {
                        logo.querySelector('a').style.display = 'block';
                        logo.style.justifyContent = 'center';
                    }
                }
            });

            // Close sidebar on outside click for mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && !hamburgerSidebar.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });

            // Responsive behavior on load and resize
            function checkWindowSize() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('collapsed');
                    sidebar.classList.remove('active');
                    logo.querySelector('a').style.display = 'none';
                    logo.style.justifyContent = 'center';
                } else {
                    sidebar.classList.remove('active');
                    sidebar.classList.remove('collapsed');
                    logo.querySelector('a').style.display = 'block';
                    logo.style.justifyContent = 'center';
                }
            }

            window.addEventListener('resize', checkWindowSize);
            window.addEventListener('load', checkWindowSize);
        });
    </script>
    @yield('scripts')
</body>
</html>
