<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
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
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .logo-text {
            font-weight: 600;
            font-size: 1.5em;
        }

        .menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
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

        .submenu {
            list-style: none;
            padding-left: 30px;
            margin-top: -5px;
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
        }

        /* Main Content Styling */
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-title {
            font-size: 2em;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Card Styling */
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 180px;
            transition: transform 0.3s, box-shadow 0.3s;
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
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9em;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-ajukan:hover, .btn-detail:hover {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
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

        /* Media Queries untuk responsif */
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
            }
            .main-content {
                padding: 20px;
            }
            .card-container, .statistic-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <div class="logo">
            <img src="lldikti logo.png" alt="LLDIKTI Logo">
            <span class="logo-text">LOGO</span>
        </div>
        <ul class="menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="menu-item"><i class="fas fa-cogs"></i> Pemeliharaan</li>
            <ul class="submenu">
                <li><a href="#">Perbaikan</a></li>
                <li><a href="#">Pembelian Sparepart</a></li>
            </ul>
            <li><a href="#">Peminjaman</a></li>
            <li><a href="#">Laporan Saya</a></li>
            <li class="logout"><a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-left">
                <span class="header-title">HOME</span>
            </div>
        </div>

        <div class="card-container">
            <div class="card blue-card">
                <h3>Perbaikan</h3>
                <button class="btn-ajukan">Ajukan</button>
                <i class="icon fas fa-cogs"></i>
            </div>
            <div class="card orange-card">
                <h3>Pembelian Sparepart</h3>
                <button class="btn-ajukan">Ajukan</button>
                <i class="icon fas fa-wrench"></i>
            </div>
            <div class="card green-card">
                <h3>Peminjaman</h3>
                <button class="btn-ajukan">Ajukan</button>
                <i class="icon fas fa-box-open"></i>
            </div>
            <div class="card purple-card">
                <h3>Laporan Saya</h3>
                <button class="btn-detail">Lihat Detail</button>
                <i class="icon fas fa-user"></i>
            </div>
        </div>

        <h2 class="section-title"><i class="fas fa-chart-bar"></i> Statistik Singkat</h2>
        <div class="statistic-container">
            <div class="stat-card">
                <div class="stat-number">12</div>
                <div class="stat-text">Pengajuan Perbaikan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">7</div>
                <div class="stat-text">Pembelian Sparepart</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div class="stat-text">Peminjaman Aktif</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">20</div>
                <div class="stat-text">Total Laporan</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>