<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            display: flex;
            overflow-x: hidden;
        }

        /* 🔹 SIDEBAR UTAMA */
        .sidebar {
            width: 250px;
            min-width: 250px;
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
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        /* 🔹 Saat sidebar disembunyikan di desktop */
        .sidebar.hidden {
            width: 0;
            padding: 0;
            overflow: hidden;
        }

        /* --- HEADER SIDEBAR --- */
        .sidebar .sidebar-header-custom {
            display: flex;
            align-items: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid #3e495d;
            margin-bottom: 20px;
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .sidebar .sidebar-header-custom .logo-container img {
            max-width: 70px;
            height: auto;
            object-fit: contain;
            margin-right: 20px;
        }

        .sidebar .sidebar-header-custom .pimpinan-info h3 {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .sidebar .sidebar-header-custom .pimpinan-info p {
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
            padding: 0 0;
            margin-top: 20px;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar .menu-item {
            margin-bottom: 5px;
        }

        /* --- LINK MENU --- */
        .sidebar .menu-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #b0c4de;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.8rem;
        }

        .sidebar .menu-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar .menu-link:hover {
            background-color: #4a73df;
            color: #fff;
            font-weight: 600;
        }

        .sidebar .menu-link.active {
            background-color: #4a73df;
            color: #fff;
            font-weight: 600;
            position: relative;
        }

        .sidebar .menu-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        /* --- DROPDOWN MENU --- */
        .sidebar .dropdown-toggle {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar .dropdown-menu {
            list-style: none;
            padding-left: 0;
            margin: 0;
            display: none;
            background-color: #0d1e37;
        }

        .sidebar .dropdown-menu.show {
            display: block;
        }

        .sidebar .dropdown-menu .menu-link {
            padding-left: 30px;
            font-size: 0.8rem;
            color: #b0c4de;
        }

        .sidebar .dropdown-menu .menu-link:hover {
            color: #fff;
        }

        /* --- LOGOUT LINK --- */
        .sidebar .logout-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #dc3545;
            text-decoration: none;
            font-size: 0.9rem;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            margin-top: 10px;
        }

        .sidebar .logout-link:hover {
            background-color: #1a2a44;
        }

        /* --- KONTEN UTAMA --- */
        .main-content-wrapper-shifted {
            margin-left: 250px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        /* 🔹 Kalau sidebar disembunyikan */
        .main-content-wrapper-shifted.full {
            margin-left: 0;
        }

.top-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
    position: sticky;
    top: 0;
    z-index: 999;
    width: 100%;
}

.top-navbar .right-section {
    display: flex;
    align-items: center;
    gap: 15px;
}

.top-navbar .menu-toggle {
    cursor: pointer;
    font-size: 1.3rem;
    color: #4a73df;
    transition: color 0.3s;
}

.top-navbar .menu-toggle:hover {
    color: #2c4fa5;
}

.top-navbar .user-info {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    color: #333;
}

.top-navbar .user-info i {
    font-size: 1.5rem;
    color: #4a73df;
}


        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100%;
                left: -100%;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content-wrapper-shifted {
                margin-left: 0;
            } 
        }

.main-content-wrapper {
    padding: 20px;
}

    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div>
            <div class="sidebar-header-custom">
                <div class="logo-container">
                    <img src="lldikti-logo.png" alt="Logo">
                </div>
                <div class="pimpinan-info">
                    <h3>Pimpinan</h3>
                    <p>Panel</p>
                </div>
            </div>

            <div class="menu-header">MENU UTAMA</div>
            <ul class="menu">
                <li class="menu-item">
                    <a href="{{ route('dashboardpimpinan') }}" class="menu-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('peminjamanpimpinan') }}" class="menu-link {{ Request::routeIs('peminjamanpimpinan') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i> Peminjaman Aset
                    </a>
                </li>

                <li class="menu-item dropdown {{ Request::routeIs(['perbaikanpimpinan','sparepartpimpinan']) ? 'active' : '' }}">
                    <a class="menu-link dropdown-toggle" href="#" role="button" data-dropdown-id="pemeliharaan-menu">
                        <i class="fas fa-tools"></i> Pemeliharaan Aset
                    </a>
                    <ul class="dropdown-menu {{ Request::routeIs(['perbaikanpimpinan','sparepartpimpinan']) ? 'show' : '' }}" id="pemeliharaan-menu">
                        <li class="menu-item">
                            <a href="{{ route('perbaikanpimpinan') }}" class="menu-link {{ Request::routeIs('perbaikanpimpinan') ? 'active' : '' }}">
                                <i class="fas fa-wrench"></i> Pengajuan Perbaikan
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('sparepartpimpinan') }}" class="menu-link {{ Request::routeIs('sparepartpimpinan') ? 'active' : '' }}">
                                <i class="fas fa-cart-plus"></i> Pembelian Sparepart
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="{{ route('laporanpimpinan') }}" class="menu-link">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>
                </li>

                <li class="menu-separator"></li>
                <li class="menu-item">
                    <a href="login" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

   <div class="main-content-wrapper-shifted" id="main-content">
        <div class="top-navbar">
    <div class="welcome">Selamat Datang, Pimpinan!</div>
    <div class="right-section">
        <div class="user-info">
            <span class="user-name d-none d-md-inline">Pimpinan</span>
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</div>


        <div class="main-content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const menuToggle = document.getElementById('menu-toggle');

    // 🔹 FUNGSI DROPDOWN
    document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.closest('.menu-item.dropdown');
            const menu = parent.querySelector('.dropdown-menu');
            menu.classList.toggle('show');
        });
    });

    // 🔹 TOGGLE SIDEBAR (desktop & mobile)
    menuToggle.addEventListener('click', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('full');
        } else {
            sidebar.classList.toggle('active');
        }
    });

    // 🔹 Klik di luar sidebar (khusus mobile)
    document.addEventListener('click', function (e) {
        if (
            window.innerWidth <= 768 &&
            sidebar.classList.contains('active') &&
            !sidebar.contains(e.target) &&
            !menuToggle.contains(e.target)
        ) {
            sidebar.classList.remove('active');
        }
    });

    // 🔹 Tambahkan class 'shifted' agar halaman laporan tetap punya jarak
    if (!sidebar.classList.contains('hidden') && window.innerWidth > 768) {
        mainContent.classList.remove('full');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('menu-toggle');
    const contentWrapper = document.getElementById('content-wrapper');

    if (toggleBtn && sidebar && contentWrapper) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            contentWrapper.classList.toggle('ml-64'); // jarak default sidebar
        });
    }
});


</script>


    @yield('scripts')
</body>
</html>
