@extends('layouts.pimpinan')

@section('title', 'Dashboard Persetujuan sparepart Aset')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan - Persetujuan sparepart</title>
    {{-- Memuat Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Palet Warna Kustom */
        :root {
            --color-primary: #1E3A8A; /* Biru Gelap (Kontrol) */
            --color-danger: #DC2626; /* Merah (Aksi Mendesak) */
            --color-warning: #D97706; /* Kuning/Oranye (Peringatan) */
            --color-success: #059669; /* Hijau (Disetujui/Sukses) */
            --color-white: #FFFFFF;
            --color-gray-100: #F3F4F6;
            --color-gray-200: #E5E7EB;
            --color-gray-300: #D1D5DB;
            --color-gray-400: #9CA3AF;
            --color-gray-500: #6B7280;
            --color-gray-600: #4B5563;
            --color-gray-700: #374151;
            --color-gray-800: #1F2937;
            --color-blue-600: #2563EB;
            --color-blue-700: #1D4ED8;
        }

        /* Styling Global */
        body {
            background-color: var(--color-gray-100);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .flex-1 { flex: 1 1 0%; }
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .overflow-hidden { overflow: hidden; }
        .overflow-y-auto { overflow-y: auto; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .flex-shrink-0 { flex-shrink: 0; }
        .transition-all { transition: all 0.3s ease; }
        .duration-300 { transition-duration: 300ms; }
        .cursor-pointer { cursor: pointer; }
        .uppercase { text-transform: uppercase; }
        .text-white { color: var(--color-white); }

        /* Main Content */
        main {
            padding: 1rem; /* p-4 */
            padding-bottom: 2.5rem; /* p-10 (approx for larger padding) */
            padding-top: 2.5rem;
            margin: 0 auto;
            max-width: 100%; /* For full width layout */
        }
        @media (min-width: 768px) {
            main {
                padding: 2.5rem; /* md:p-10 */
            }
        }
        .space-y-10 > * + * { margin-top: 2.5rem; }

        /* Headings */
        h1 { font-size: 1.5rem; line-height: 2rem; font-weight: 800; color: var(--color-gray-800); margin-bottom: 1.25rem; } /* text-2xl font-extrabold mb-5 */
        h2 { font-size: 1.25rem; line-height: 1.75rem; font-weight: 800; color: var(--color-gray-800); margin-bottom: 1.25rem; } /* text-xl font-extrabold mb-5 */
        h3 { font-size: 0.875rem; line-height: 1.25rem; font-weight: 600; color: rgba(255, 255, 255, 0.9); letter-spacing: 0.05em; margin-bottom: 0.25rem; } /* text-sm font-semibold tracking-widest mb-1 */
        .text-blue-600 { color: var(--color-blue-600); }
        .mr-2 { margin-right: 0.5rem; }
        .ml-1 { margin-left: 0.25rem; }
        .ml-2 { margin-left: 0.5rem; }

        /* Separator */
        .border-gray-300 { border-color: var(--color-gray-300); }
        hr { border: 0; border-top: 1px solid var(--color-gray-300); }

        /* Card Colors */
        .bg-card-primary { background-color: var(--color-primary); }
        .bg-card-danger { background-color: var(--color-danger); }
        .bg-card-warning { background-color: var(--color-warning); }
        .bg-card-success { background-color: var(--color-success); }
        
        /* Card Styling */
        .card-shadow-xl { 
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1), 
                        0 4px 6px rgba(0, 0, 0, 0.05); 
            border-radius: 0.75rem; /* rounded-xl */
        }
        .p-6 { padding: 1.5rem; }
        .w-full { width: 100%; }

        /* Hover Effect Pop-up */
        .card-hover-pop { transform: translateY(0) scale(1); }
        .card-hover-pop:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Card Content */
        .text-5xl { font-size: 3rem; line-height: 1; } /* text-5xl (override, 3rem is approx 48px) */
        .font-extrabold { font-weight: 800; }
        .mt-1 { margin-top: 0.25rem; }
        .text-xs { font-size: 0.75rem; line-height: 1rem; }
        .text-white\/70 { color: rgba(255, 255, 255, 0.7); }

        .h-14 { height: 3.5rem; }
        .w-14 { width: 3.5rem; }
        .bg-white\/20 { background-color: rgba(255, 255, 255, 0.2); }
        .rounded-full { border-radius: 9999px; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }

        .card-action-link { 
            margin-top: 1rem; /* mt-4 */
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.5rem 1rem; /* py-2 */
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: background-color 0.2s;
            display: block; /* Mengubah dari p menjadi block element */
        }
        .card-action-link:hover { background-color: rgba(255, 255, 255, 0.2); }

        /* Grid for Cards */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 2rem; /* gap-8 */
        }
        @media (min-width: 640px) { /* sm:grid-cols-2 */
            .card-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (min-width: 1024px) { /* lg:grid-cols-4 */
            .card-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }

        /* Filter Section */
        .bg-white { background-color: var(--color-white); }

        /* Search Bar */
        .search-container { position: relative; width: 100%; margin-bottom: 1.5rem; }
        .search-input {
            border: 2px solid var(--color-gray-300);
            border-radius: 0.75rem; /* rounded-xl */
            padding: 0.75rem 1.25rem 0.75rem 3.5rem; /* px-5 py-3 pl-14 */
            font-size: 1rem;
            width: 100%;
            transition: all 0.15s ease;
            color: var(--color-gray-800);
            font-weight: 500;
        }
        .search-input:focus { 
            outline: none;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2); /* focus:ring-4 focus:ring-blue-200 (approx) */
            border-color: var(--color-blue-600); /* focus:border-blue-600 */
        }
        .search-icon {
            position: absolute;
            left: 1.25rem; /* left-5 */
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-gray-400);
            width: 1.25rem;
            height: 1.25rem;
        }

        /* Filter Group */
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem; /* gap-6 */
        }
        @media (min-width: 768px) {
            .filter-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } /* md:grid-cols-3 */
        }
        
        .filter-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-gray-700);
            margin-bottom: 0.5rem;
        }

        .filter-select, .filter-date {
            display: block;
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 1rem; /* pl-4 pr-10 py-3 */
            font-size: 1rem;
            border: 2px solid var(--color-gray-300);
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .filter-date { padding-right: 1rem; } /* pr-4 */
        .filter-select:focus, .filter-date:focus { 
            outline: none;
            border-color: var(--color-blue-600);
            box-shadow: 0 0 0 1px var(--color-blue-600); /* focus:ring */
        }

        .date-input-group { display: flex; align-items: center; gap: 0.75rem; } /* flex items-center space-x-3 */
        .reset-button {
            flex-shrink: 0;
            padding: 0.75rem; /* p-3 */
            font-size: 1rem;
            background-color: var(--color-gray-200);
            border-radius: 0.75rem;
            color: var(--color-gray-700);
            transition: background-color 0.15s ease;
        }
        .reset-button:hover { background-color: var(--color-gray-300); }

        /* Table Styling */
        #permohonan-table-section { overflow: hidden; }
        .table-title-bar { 
            background-color: var(--color-warning); 
            padding: 1.25rem 1.5rem; /* py-5 px-6 */
            color: var(--color-white);
            font-size: 1.25rem;
            font-weight: 800;
            text-align: center;
            letter-spacing: 0.05em; /* tracking-wider */
        }
        @media (min-width: 768px) {
            .table-title-bar { font-size: 1.5rem; } /* md:text-2xl */
        }

        .overflow-x-auto { overflow-x: auto; }
        .max-h-96 { max-height: 24rem; } /* max-h-96 */
        .min-w-full { min-width: 100%; }
        .table-auto { border-collapse: collapse; }

        /* Table Header */
        thead { position: sticky; top: 0; z-index: 20; }
        th { 
            position: sticky; top: 0; z-index: 20; 
            background-color: var(--color-gray-200); /* bg-gray-200 */
            color: var(--color-gray-700); 
            border-bottom: 2px solid var(--color-gray-300);
            padding: 0.75rem 1rem; /* px-4 py-3 */
            font-weight: 700;
            text-align: left;
            white-space: nowrap;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        .text-center { text-align: center; }

        /* Sticky Columns */
        .sticky-col { position: sticky; left: 0; z-index: 10; border-right: 1px solid var(--color-gray-200); }
        .sticky-action { position: sticky; right: 0; z-index: 10; border-left: 1px solid var(--color-gray-200); }
        
        /* Sticky Header Adjustment */
        .sticky-col.header, .sticky-action.header { background-color: var(--color-gray-200); }
        .sticky-col.header { border-right: 1px solid var(--color-gray-300); }
        .sticky-action.header { border-left: 1px solid var(--color-gray-300); }

        /* Table Body Rows */
        tr { transition: background-color 0.15s ease; }
        .bg-odd-row { background-color: #F9FAFB; }
        .bg-even-row { background-color: var(--color-white); }
        tr:hover { background-color: #EFF6FF; } /* hover:bg-blue-50 */

        /* Sticky Column Adjustments for zebra stripping */
        tr:nth-child(odd) .sticky-col,
        tr:nth-child(odd) .sticky-action { background-color: #F9FAFB; }
        tr:nth-child(even) .sticky-col,
        tr:nth-child(even) .sticky-action { background-color: var(--color-white); }

        tr:hover .sticky-col,
        tr:hover .sticky-action { background-color: #EFF6FF; } /* Apply hover to sticky cells */

        /* Table Data Cells */
        td {
            padding: 1rem 1rem; /* px-4 py-4 */
            border-bottom: 1px solid var(--color-gray-200);
            font-size: 0.875rem;
            color: var(--color-gray-700);
            white-space: nowrap;
        }
        td .font-semibold { font-weight: 600; color: var(--color-gray-800); }
        td .text-gray-600 { color: var(--color-gray-600); }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 0.25rem 1rem; /* px-4 py-1 */
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--color-white);
            border-radius: 9999px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
            animation: none;
        }
        .status-badge.pending { background-color: #DC2626; animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; } /* bg-red-600 animate-pulse */
        .status-badge.disetujui { background-color: #059669; } /* bg-green-600 */
        .status-badge.ditolak { background-color: var(--color-gray-500); } /* bg-gray-500 */

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Action Button */
        .action-link {
            display: inline-block;
            background-color: var(--color-blue-600);
            border-radius: 9999px;
            padding: 0.25rem 0.75rem; /* px-3 py-1 */
            color: var(--color-white);
            font-size: 0.75rem;
            font-weight: 600;
            transition: background-color 0.15s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1); /* shadow-md */
            text-decoration: none;
        }
        .action-link:hover { background-color: var(--color-blue-700); }
        .action-link.red { background-color: #DC2626; }
        .action-link.red:hover { background-color: #B91C1C; } /* hover:bg-red-700 */
        .action-link.gray { background-color: var(--color-gray-400); cursor: not-allowed; }
        .action-link.gray:hover { background-color: var(--color-gray-400); }

        /* Footer Info */
        .table-footer {
            text-align: center;
            color: var(--color-gray-600);
            font-size: 0.875rem;
            padding: 1rem 0; /* py-4 */
            background-color: #F9FAFB; /* bg-gray-50 (override to match odd row) */
            border-top: 1px solid var(--color-gray-200);
        }

    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <main class="flex-1 overflow-y-auto p-4 md:p-10 space-y-10">
            
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-clipboard-check text-blue-600 mr-2"></i>
                    RINGKASAN PERSETUJUAN PEMBELIAN SPAREPART
                </h1>
            </div>
            <hr class="border-gray-300">
            
            {{-- ## Dashboard Cards (Fokus pada Aksi Cepat) --}}
            <div class="card-grid">
                
                {{-- Card 1: Perlu Persetujuan (Mendesak - Danger) --}}
                <div data-filter="pending" class="action-card bg-card-danger text-white p-6 card-shadow-xl w-full card-hover-pop cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="uppercase tracking-widest mb-1">PERLU TINDAK LANJUT</h3>
                            <p class="text-5xl font-extrabold mt-1">3</p> 
                            <span class="text-xs text-white/70">Permohonan menunggu review</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-gavel text-white text-2xl"></i>
                        </div>
                    </div>
                    <a href="#" class="card-action-link">
                        Klik untuk Tinjau <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                {{-- Card 2: Pembelian Aktif (Primary) --}}
                <div data-filter="disetujui" class="action-card bg-card-primary text-white p-6 card-shadow-xl w-full card-hover-pop cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="uppercase tracking-widest mb-1">PEMBELIAN AKTIF</h3>
                            <p class="text-5xl font-extrabold mt-1">60</p>
                            <span class="text-xs text-white/70">Total aset sedang dibeli</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exchange-alt text-white text-2xl"></i>
                        </div>
                    </div>
                    <a href="#" class="card-action-link">
                        Klik untuk Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                {{-- Card 3: Ditolak (Warning) --}}
                <div data-filter="terlambat" class="action-card bg-card-warning text-white p-6 card-shadow-xl w-full card-hover-pop cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="uppercase tracking-widest mb-1">DITOLAK</h3>
                            <p class="text-5xl font-extrabold mt-1">5</p>
                            <span class="text-xs text-white/70">Pengajuan ditolak</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                    <a href="#" class="card-action-link">
                        Klik untuk Peringatan <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                {{-- Card 4: Total Disetujui (Success) --}}
                <div data-filter="disetujui-bulan-ini" class="action-card bg-card-success text-white p-6 card-shadow-xl w-full card-hover-pop cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="uppercase tracking-widest mb-1">DISETUJUI (BULAN INI)</h3>
                            <p class="text-5xl font-extrabold mt-1">15</p>
                            <span class="text-xs text-white/70">Permintaan berhasil disetujui</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-thumbs-up text-white text-2xl"></i>
                        </div>
                    </div>
                    <a href="#" class="card-action-link">
                        Klik untuk Histori <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <hr class="border-gray-300">

            {{-- ## Filter dan Pencarian Canggih --}}
            <div class="bg-white p-6 card-shadow-xl">
                <h2 class="text-xl font-extrabold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-sliders-h text-blue-600 mr-2"></i> Pengaturan Tampilan & Pencarian
                </h2>
                
                {{-- Search Bar --}}
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="CARI BERDASARKAN KODE ASET, NAMA PENGAJU, NAMA ASET..."
                            class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>

                {{-- Filter Group --}}
                <div class="filter-grid">
                    
                    {{-- Filter Status --}}
                    <div>
                        <label for="filter-status" class="filter-label">Status Permohonan</label>
                        <select id="filter-status" class="filter-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending (Menunggu)</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    {{-- Filter Tanggal Mulai --}}
                    <div>
                        <label for="filter-start-date" class="filter-label">Tanggal Mulai Peminjaman</label>
                        <div class="date-input-group">
                            <input type="date" id="filter-start-date" class="filter-date">
                            <button type="button" id="reset-start-date" class="reset-button" title="Reset Tanggal Mulai">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Tanggal Selesai --}}
                    <div>
                        <label for="filter-end-date" class="filter-label">Tanggal Akhir Peminjaman</label>
                        <div class="date-input-group">
                            <input type="date" id="filter-end-date" class="filter-date">
                            <button type="button" id="reset-end-date" class="reset-button" title="Reset Tanggal Akhir">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="border-gray-300">

            {{-- ## Tabel DAFTAR PERMOHONAN PEMBELIAN SPAREPART--}}
            <div class="bg-white card-shadow-xl" id="permohonan-table-section" style="border-radius: 0.75rem;">
                <div class="table-title-bar">
                    DAFTAR PERMOHONAN PEMBELIAN SPAREPART<i class="fas fa-list-alt ml-2"></i>
                </div>
                
                {{-- Kontainer Tabel yang Dapat Di-scroll Horizontal --}}
                <div class="overflow-x-auto max-h-96">
                    <table class="min-w-full table-auto" id="permohonan-table">
                        <thead>
                            <tr class="uppercase text-xs tracking-wider">
                                <th class="sticky-col header text-center font-bold whitespace-nowrap">NO</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Tanggal Pengajuan</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Kode Aset</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Nama Aset</th>
                                <th class="px-4 py-3 text-center font-bold whitespace-nowrap">Jumlah</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Diajukan oleh</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Unit/Divisi</th>
                                <th class="px-4 py-3 text-center font-bold whitespace-nowrap">Status</th>
                                <th class="sticky-action header text-center font-bold whitespace-nowrap">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            {{-- Row 1: Disetujui (Ganjil) --}} 
                            <tr class="bg-odd-row" data-status-val="disetujui" data-date="2025-09-14">
                                <td class="sticky-col text-center font-medium text-gray-600">1</td>
                                <td>14/09/2025</td>
                                <td data-col="kode_aset">123456789</td>
                                <td data-col="aset">Laptop ASUS ROG</td>
                                <td class="text-center">1</td>
                                <td class="font-semibold" data-col="nama">Andi Purnomo</td>
                                <td data-col="unit">IT Dept.</td>
                                <td class="text-center">
                                    <span class="status-badge disetujui">
                                        Disetujui
                                    </span>
                                </td>
                                <td class="sticky-action text-center">
                                    <a href="#" class="action-link">
                                        <i class="fas fa-info-circle mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            
                            {{-- Row 2: Pending (Genap) - Target Utama Pimpinan --}}
                            <tr class="bg-even-row" data-status-val="pending" data-date="2025-09-20">
                                <td class="sticky-col text-center font-medium text-gray-600">2</td>
                                <td>20/09/2025</td>
                                <td data-col="kode_aset">987654321</td>
                                <td data-col="aset">Proyektor EPSON</td>
                                <td class="text-center">1</td>
                                <td class="font-semibold" data-col="nama">Budi Santoso</td>
                                <td data-col="unit">HRD</td>
                                <td class="text-center">
                                    <span class="status-badge pending">
                                        Pending
                                    </span>
                                </td>
                                <td class="sticky-action text-center">
                                    <a href="#" class="action-link red">
                                        <i class="fas fa-file-signature mr-1"></i> Tindak Lanjut
                                    </a>
                                </td>
                            </tr>

                            {{-- Row 3: Ditolak (Ganjil) --}}
                            <tr class="bg-odd-row" data-status-val="ditolak" data-date="2025-09-22">
                                <td class="sticky-col text-center font-medium text-gray-600">3</td>
                                <td>22/09/2025</td>
                                <td data-col="kode_aset">555444333</td>
                                <td data-col="aset">Kamera DSLR</td>
                                <td class="text-center" data-col="jumlah">2</td>
                                <td class="font-semibold" data-col="nama">Citra Dewi</td>
                                <td data-col="unit">Marketing</td>
                                <td class="text-center">
                                    <span class="status-badge ditolak">
                                        Ditolak
                                    </span>
                                </td>
                                <td class="sticky-action text-center">
                                    <a href="#" class="action-link gray">
                                        <i class="fas fa-times-circle mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>

                            {{-- Tambahkan baris data dummy lainnya di sini --}}
                            
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span id="display-row-count">Menampilkan 3 dari 3 Permohonan Baru.</span>
                </div>
            </div>
        </main>
    </div>

    {{-- Script untuk Fungsionalitas Filter dan Card Click (Tidak diubah) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('filter-status');
            const startDateInput = document.getElementById('filter-start-date');
            const endDateInput = document.getElementById('filter-end-date');
            const tableBody = document.querySelector('#permohonan-table tbody');
            // Ambil semua TR KECUALI yang merupakan dummy, jika ada. Di sini kita asumsikan semua TR adalah data.
            const tableRows = Array.from(tableBody.querySelectorAll('tr')); 
            const displayCountElement = document.getElementById('display-row-count');
            const actionCards = document.querySelectorAll('.action-card');

            // --- DEBOUNCE FUNCTION ---
            function debounce(func, delay) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), delay);
                };
            }
            // -------------------------

            /**
             * Mengkonversi tanggal DD/MM/YYYY menjadi format YYYY-MM-DD untuk Date object.
             * @param {string} dateString - Tanggal dalam format DD/MM/YYYY
             * @returns {Date} - Objek Tanggal
             */
            function parseDate(dateString) {
                const parts = dateString.split('/');
                if (parts.length === 3) {
                    // new Date(Year, Month - 1, Day)
                    // Menggunakan YYYY-MM-DD dari atribut data-date jika ada, jika tidak, pakai teks sel.
                    const yyyymmdd = parts[2] + '-' + parts[1] + '-' + parts[0];
                    return new Date(yyyymmdd); 
                }
                return null;
            }

            /**
             * Fungsi Utama untuk Melakukan Filter
             */
            function applyFilters() {
                const searchKeyword = searchInput.value.toLowerCase().trim();
                const selectedStatus = statusFilter.value;
                
                const filterStartDate = startDateInput.value ? new Date(startDateInput.value) : null;
                const filterEndDate = endDateInput.value ? new Date(endDateInput.value) : null;
                
                // UX: Validation
                if (filterStartDate && filterEndDate && filterEndDate < filterStartDate) {
                    alert('Tanggal Akhir tidak boleh lebih awal dari Tanggal Mulai.');
                    endDateInput.value = '';
                    // Rerun filter setelah reset
                    applyFilters(); 
                    return;
                }

                if (filterStartDate) filterStartDate.setHours(0, 0, 0, 0);
                if (filterEndDate) filterEndDate.setHours(0, 0, 0, 0);


                let visibleRowCount = 0;

                tableRows.forEach(row => {
                    let isVisible = true;
                    
                    // 1. Filter Pencarian Teks (Kode, Nama, Aset)
                    if (searchKeyword) {
                        // Ambil data-col yang relevan untuk pencarian: nama, kode, aset
                        const kode = row.querySelector('[data-col="kode_aset"]')?.textContent.toLowerCase() || '';
                        const nama = row.querySelector('[data-col="nama"]')?.textContent.toLowerCase() || '';
                        const aset = row.querySelector('[data-col="aset"]')?.textContent.toLowerCase() || '';
                        const unit = row.querySelector('[data-col="unit"]')?.textContent.toLowerCase() || '';

                        if (!kode.includes(searchKeyword) && !nama.includes(searchKeyword) && !aset.includes(searchKeyword) && !unit.includes(searchKeyword)) {
                            isVisible = false;
                        }
                    }
                    
                    // 2. Filter Status
                    if (isVisible && selectedStatus) {
                        const currentRowStatus = row.getAttribute('data-status-val');
                        
                        if (selectedStatus === 'pending' && currentRowStatus !== 'pending') {
                            isVisible = false;
                        } else if (selectedStatus === 'disetujui' && currentRowStatus !== 'disetujui') {
                            isVisible = false;
                        } else if (selectedStatus === 'ditolak' && currentRowStatus !== 'ditolak') {
                            isVisible = false;
                        }
                        // Catatan: 'terlambat' dan 'disetujui-bulan-ini' memerlukan backend logic atau data-attribute tambahan.
                    }

                    // 3. Filter Tanggal
                    if (isVisible && (filterStartDate || filterEndDate)) {
                        const rowDateAttribute = row.getAttribute('data-date'); // Format YYYY-MM-DD
                        let rowDate = null;

                        if (rowDateAttribute) {
                            rowDate = new Date(rowDateAttribute);
                            rowDate.setHours(0, 0, 0, 0); 
                        } else {
                            // Fallback (jika data-date tidak tersedia, gunakan teks sel dan parse)
                            const dateCell = row.children[1];
                            const rowDateString = dateCell.textContent.trim();
                            rowDate = parseDate(rowDateString);
                            if (rowDate) rowDate.setHours(0, 0, 0, 0);
                        }
                        
                        if (rowDate) {
                            if (filterStartDate && rowDate < filterStartDate) {
                                isVisible = false;
                            }
                            if (filterEndDate && rowDate > filterEndDate) {
                                isVisible = false;
                            }
                        } else {
                            // Jika parsing gagal, sembunyikan (agar data tidak valid tidak ditampilkan)
                            isVisible = false; 
                        }
                    }

                    // Tampilkan atau sembunyikan baris
                    row.style.display = isVisible ? '' : 'none';
                    if (isVisible) {
                        visibleRowCount++;
                    }
                });
                
                // Perbarui teks jumlah baris yang ditampilkan
                displayCountElement.textContent = 
                    `Menampilkan ${visibleRowCount} dari ${tableRows.length} Permohonan Baru.`;
            }

            // --- Menghubungkan Event Listeners ---
            
            // 1. Filter Cepat dari Card Ringkasan
            actionCards.forEach(card => {
                card.addEventListener('click', function() {
                    const filterValue = this.getAttribute('data-filter');
                    
                    if (filterValue === 'pending' || filterValue === 'disetujui' || filterValue === 'ditolak') {
                        // Reset filter lain (opsional, agar fokus pada status)
                        searchInput.value = '';
                        startDateInput.value = '';
                        endDateInput.value = '';
                        
                        // Set filter status dan terapkan
                        statusFilter.value = filterValue;
                        applyFilters();
                        
                        // Scroll ke tabel
                        document.getElementById('permohonan-table-section').scrollIntoView({ behavior: 'smooth' });
                        
                    } else if (filterValue === 'terlambat') {
                        // Di sini akan diarahkan ke halaman/filter 'terlambat' yang sesungguhnya (membutuhkan data atribut yang kompleks/backend)
                        alert("Ini akan memfilter semua yang statusnya 'Aktif' tapi Tgl Kembali <= Hari Ini. (Membutuhkan logic backend atau data kolom Tgl Kembali)");
                        // Untuk demo, kita reset filter status
                        statusFilter.value = '';
                        applyFilters();

                    } else if (filterValue === 'disetujui-bulan-ini') {
                        // Di sini akan diarahkan ke halaman/filter 'disetujui' dengan range Tgl Peminjaman Bulan Ini
                        alert("Ini akan memfilter semua yang statusnya 'Disetujui' dan Tgl Peminjaman di Bulan Ini. (Membutuhkan logic tanggal yang dinamis)");
                        // Untuk demo, kita set filter status disetujui
                        statusFilter.value = 'disetujui';
                        applyFilters();
                    }
                });
            });

            // 2. Event Input dan Selector
            searchInput.addEventListener('keyup', debounce(applyFilters, 400));
            statusFilter.addEventListener('change', applyFilters);
            startDateInput.addEventListener('change', applyFilters);
            endDateInput.addEventListener('change', applyFilters);

            // 3. Tombol Reset Tanggal
            document.getElementById('reset-start-date').addEventListener('click', function() {
                startDateInput.value = '';
                applyFilters();
            });
            document.getElementById('reset-end-date').addEventListener('click', function() {
                endDateInput.value = '';
                applyFilters();
            });

            // Panggil filter awal
            applyFilters(); 
        });
    </script>
</body>
</html>
@endsection