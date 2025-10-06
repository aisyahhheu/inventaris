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
        }

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
        }


        /* --- Header Sidebar & Menu Utama Styling --- */
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
            /* Ensure natural document flow */
            position: relative;
        }

        /* --- Link Menu Umum --- */
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

        /* --- Styling untuk Indikator Menu Aktif (Sesuai Screenshot) --- */
        .sidebar .menu-link.active {
            position: relative;
            background-color: #4a73df;
            color: #fff;
            font-weight: 600;
        }

        /* Garis putih di kiri menu aktif */
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

        /* --- Dropdown Menu Styling --- */
        .sidebar .dropdown-toggle {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Style untuk link dropdown parent */
        .sidebar .menu-item.dropdown .menu-link {
            padding-right: 15px;
        }

        /* Saat menu induk sedang aktif, berikan style yang sama seperti menu lainnya */
        .sidebar .menu-item.dropdown.active>.menu-link {
            background-color: #4a73df;
            color: #fff;
            font-weight: 600;
        }


        /* Dropdown Menu */
        .sidebar .dropdown-menu {
            list-style: none;
            padding-left: 0;
            margin: 0;
            display: none;
            /* default hidden */
            background-color: #0d1e37;
        }

        .sidebar .dropdown-menu {
            position: static !important;
        }

        .sidebar .dropdown-menu.show {
            display: block;
            /* saat aktif, tampil dan otomatis mendorong menu di bawah */
        }

        .sidebar .dropdown-menu .menu-item {
            margin: 0;
        }

        /* Style untuk link submenu */
        .sidebar .dropdown-menu .menu-link {
            padding-left: 30px;
            /* Indentasi submenu */
            font-size: 0.8rem;
            color: #b0c4de;
        }

        /* Style saat link submenu dihover */
        .sidebar .dropdown-menu .menu-link:hover {
            background-color: transparent;
            color: #fff;
        }

        /* Styling untuk submenu yang aktif seperti di screenshot */
        .sidebar .dropdown-menu .menu-link.active {
            position: relative;
            background-color: transparent;
            color: #fff;
            font-weight: 600;
        }

        .sidebar .dropdown-menu .menu-link.active {
            position: relative;
            background-color: #4a73df;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            padding: 8px 16px;
            margin-top: 6px;
            margin-left: 20px;
            margin-right: 20px;
        }


        /* Penanda aktif untuk submenu (titik kecil) */
        .sidebar .dropdown-menu .menu-link.active::before {
            content: '';
            position: absolute;
            left: 15px;
            /* Sesuaikan posisi agar pas dengan indentasi */
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 5px;
            background-color: #fff;
            border-radius: 50%;
        }

        /* Added separator styling for logout section */
        .sidebar .menu-separator {
            display: flex;
            align-items: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid #3e495d;
            margin-bottom: 5px;
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 20px;
            padding-right: 20px;
        }


        /* --- Link Logout --- */
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
            margin-top: 10px;
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


        /* Scrollbar tipis sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
        }


        /* --- Konten Utama & Responsif --- */
        .main-content-wrapper-shifted {
            margin-left: 250px;
            flex-grow: 1;
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

        .main-content-wrapper {
            padding: 20px;
            flex-grow: 1;
        }

        .top-navbar .welcome {
            font-weight: 600;
            color: #333;
        }

        .top-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-navbar .user-info .user-name {
            font-weight: 500;
            color: #555;
        }

        .top-navbar .user-info i {
            font-size: 1.5rem;
            color: #4a73df;
        }

        .top-navbar .menu-toggle {
            display: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            body {
                display: block;
            }

            .sidebar {
                left: -250px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content-wrapper-shifted {
                margin-left: 0;
            }

            .top-navbar {
                width: 100%;
                left: 0;
            }

            .top-navbar .welcome,
            .top-navbar .user-info {
                display: none;
            }

            .top-navbar .menu-toggle {
                display: block;
            }

            .rotate-icon {
                transform: rotate(180deg);
                transition: transform 0.3s ease;
            }
        }

        /* Hilangkan panah kecil bawaan bootstrap */
        .sidebar .menu-link.dropdown-toggle::after {
            content: none !important;
        }

        /* Hapus bullet / pseudo-element submenu */
        .sidebar .dropdown-menu,
        .sidebar .dropdown-menu .menu-item {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .sidebar .dropdown-menu .menu-item::before,
        .sidebar .dropdown-menu .menu-link::before {
            content: none !important;
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div>
            <!-- Bagian Header Sidebar -->
            <div class="sidebar-header-custom">
                <div class="logo-container">
                    <!-- Placeholder untuk Logo, ganti dengan gambar Anda -->
                    <img src="lldikti-logo.png" alt="Logo">
                </div>
                <div class="admin-info">
                    <h3>Admin</h3>
                    <p>Panel</p>
                </div>
            </div>

            <div class="menu-header">MENU UTAMA</div>
            <ul class="menu">
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="menu-item dropdown  {{ Request::routeIs(['barangmasuk','barangkeluar','dataaset']) ? 'active' : '' }}">
                    <a class="menu-link dropdown-toggle" href="#" role="button" data-dropdown-id="inventaris-menu">
                        <i class="fas fa-boxes"></i> Manajemen Inventaris
                        <i class="fas fa-chevron-down ms-2
                         {{ Request::routeIs(['barangmasuk','barangkeluar','dataaset']) ? 'rotate-icon' : '' }}">
                        </i>
                    </a>

                    <ul class="dropdown-menu {{ Request::routeIs(['barangmasuk','barangkeluar','dataaset']) ? 'show' : '' }}"
                        id="inventaris-menu">

                        <li class="menu-item">
                            <a href="{{ route('barangmasuk') }}"
                                class="menu-link {{ Request::routeIs('barangmasuk') ? 'active' : '' }}">
                                <i class="fas fa-download"></i> Barang Masuk
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('barangkeluar') }}"
                                class="menu-link {{ Request::routeIs('barangkeluar') ? 'active' : '' }}">
                                <i class="fas fa-upload"></i> Barang Keluar
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('dataaset') }}"
                                class="menu-link {{ Request::routeIs('dataaset') ? 'active' : '' }}">
                                <i class="fas fa-database"></i> Data Aset
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="{{ route('peminjaman.index') }}"
                        class="menu-link {{ Request::routeIs('peminjaman.index') ? 'active' : '' }}">
                        <i class="fas fa-handshake"></i> Peminjaman Aset
                    </a>
                </li>
                <li class="menu-item dropdown {{ Request::routeIs(['pengajuanperbaikan','pembeliansparepart']) ? 'active' : '' }}">
                    <a class="menu-link dropdown-toggle" href="#" role="button" data-dropdown-id="pemeliharaan-menu">
                        <i class="fas fa-tools"></i> Pemeliharaan Aset
                        <i class="fas fa-chevron-down ms-2
                         {{ Request::routeIs(['pengajuanperbaikan','pembeliansparepart']) ? 'rotate-icon' : '' }}">
                        </i>
                    </a>

                    <ul class="dropdown-menu {{ Request::routeIs(['pengajuanperbaikan','pembeliansparepart']) ? 'show' : '' }}"
                        id="pemeliharaan-menu">

                        <li class="menu-item">
                            <a href="{{ route('pengajuanperbaikan') }}"
                                class="menu-link {{ Request::routeIs('pengajuanperbaikan') ? 'active' : '' }}">
                                <i class="fas fa-wrench"></i> Pengajuan Perbaikan
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('pembeliansparepart') }}"
                                class="menu-link {{ Request::routeIs('pembeliansparepart') ? 'active' : '' }}">
                                <i class="fas fa-cart-plus"></i> Pembelian Sparepart
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>
                </li>
                <!-- Added separator and moved logout below reports -->
                <li class="menu-separator"></li>
                <li class="menu-item">
                    <a href="#" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
        <!-- Removed logout from bottom section since it's now in the menu -->
    </div>

    <div class="main-content-wrapper-shifted">
        <div class="top-navbar">
            <div class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="welcome">Selamat Datang, Admin!</div>
            <div class="user-info">
                <span class="user-name d-none d-md-inline">Admin</span>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>

        <div class="main-content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function slideDown(element) {
                element.classList.add('show');
            }

            function slideUp(element) {
                element.classList.remove('show');
            }

            function slideToggle(element) {
                if (element.classList.contains('show')) {
                    slideUp(element);
                } else {
                    slideDown(element);
                }
            }

            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(event) {
                    event.preventDefault();
                    const parentItem = this.closest('.menu-item.dropdown');
                    const dropdownMenu = parentItem.querySelector('.dropdown-menu');
                    const arrowIcon = this.querySelector('.fa-chevron-down');
                    const isExpanded = dropdownMenu.classList.contains('show');

                    // Tutup semua dropdown lain yang terbuka
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            slideUp(menu);
                            const otherArrow = menu.closest('.menu-item.dropdown').querySelector('.fa-chevron-down');
                            if (otherArrow) otherArrow.style.transform = 'rotate(0deg)';
                            menu.closest('.menu-item.dropdown').classList.remove('active');
                        }
                    });

                    if (arrowIcon) {
                        arrowIcon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(180deg)';
                    }

                    // Toggle dropdown
                    slideToggle(dropdownMenu);

                    // Toggle kelas aktif pada parent
                    parentItem.classList.toggle('active', !isExpanded);
                });
            });

            // Toggle sidebar (mobile)
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content-wrapper-shifted');

            if (menuToggle && sidebar && mainContent) {
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    mainContent.classList.toggle('active');
                });

                // Klik luar sidebar menutup sidebar (mobile)
                document.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768 &&
                        sidebar.classList.contains('active') &&
                        !sidebar.contains(e.target) &&
                        !menuToggle.contains(e.target)) {
                        sidebar.classList.remove('active');
                        mainContent.classList.remove('active');
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>