@extends('layouts.pimpinan')

@section('title', 'Dashboard Persetujuan Peminjaman Aset')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan - Persetujuan Peminjaman</title>
    {{-- Memuat Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    {{-- CSS MURNI DI SINI --}}
    <style>
/* ====================================== */
/* CSS MURNI (Pure CSS)          */
/* ====================================== */

/* --- PALET WARNA & VARIABEL --- */
:root {
    --color-primary: #1E3A8A; /* Biru Gelap (Kontrol) */
    --color-danger: #DC2626; /* Merah (Aksi Mendesak) */
    --color-warning: #D97706; /* Kuning/Oranye (Peringatan) */
    --color-success: #059669; /* Hijau (Disetujui/Sukses) */
    --color-bg-light: #f3f4f6; /* bg-gray-100 */
    --color-text-dark: #1f2937; /* text-gray-800 */
    --color-text-medium: #4b5563; /* text-gray-700 */
    --color-border: #d1d5db; /* border-gray-300 */
}

/* --- BASE STYLES --- */
body {
    background-color: var(--color-bg-light);
    font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.dashboard-container {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    flex: 1;
}

.main-content {
    flex: 1;
    overflow-y: auto;
    padding: 2.5rem; /* md:p-10 */
    display: flex;
    flex-direction: column;
    gap: 2.5rem; /* space-y-10 */
}
@media (max-width: 767px) {
    .main-content {
        padding: 1rem;
        gap: 1rem;
    }
}

.section-divider {
    border-top: 1px solid var(--color-border);
    margin: 0;
}

/* --- HEADINGS --- */
.h1-title {
    font-size: 1.5rem; /* text-2xl */
    font-weight: 800; /* font-extrabold */
    color: var(--color-text-dark);
    margin-bottom: 1.25rem; /* mb-5 */
    display: flex;
    align-items: center;
}
.h1-title i {
    color: #2563eb; /* text-blue-600 */
    margin-right: 0.5rem;
}

/* --- CARD STYLES --- */
.card-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    gap: 2rem; /* gap-8 */
}
@media (min-width: 640px) {
    .card-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)); /* sm:grid-cols-2 */
    }
}
@media (min-width: 1024px) {
    .card-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr)); /* lg:grid-cols-4 */
    }
}

.action-card {
    padding: 1.5rem; /* p-6 */
    border-radius: 0.75rem; /* rounded-xl */
    width: 100%;
    transition: all 0.3s ease; /* transition-all duration-300 */
    cursor: pointer;
    color: white;
}

/* Box Shadow "Wahh" (Elegance) */
.card-shadow-xl { 
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1), 
                0 4px 6px rgba(0, 0, 0, 0.05); 
}

/* Hover Effect Pop-up */
.card-hover-pop:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Warna Card */
.bg-card-primary { background-color: var(--color-primary); }
.bg-card-danger { background-color: var(--color-danger); }
.bg-card-warning { background-color: var(--color-warning); }
.bg-card-success { background-color: var(--color-success); }

/* Konten Card */
.card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}
.card-title {
    font-size: 0.875rem; /* text-sm */
    font-weight: 600; /* font-semibold */
    color: rgba(255, 255, 255, 0.9); /* text-white/90 */
    text-transform: uppercase;
    letter-spacing: 0.05em; /* tracking-widest */
    margin-bottom: 0.25rem; /* mb-1 */
}
.card-value {
    font-size: 3rem; /* text-5xl */
    font-weight: 800; /* font-extrabold */
    margin-top: 0.25rem; /* mt-1 */
}
.card-subtitle {
    font-size: 0.75rem; /* text-xs */
    color: rgba(255, 255, 255, 0.7); /* text-white/70 */
}
.card-icon-wrapper {
    height: 3.5rem; /* h-14 */
    width: 3.5rem; /* w-14 */
    background-color: rgba(255, 255, 255, 0.2); /* bg-white/20 */
    border-radius: 9999px; /* rounded-full */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.card-icon-wrapper i {
    font-size: 1.5rem; /* text-2xl */
    color: white;
}
.card-action-link {
    margin-top: 1rem; /* mt-4 */
    text-align: center;
    font-size: 0.75rem; /* text-xs */
    font-weight: 600; /* font-semibold */
    text-transform: uppercase;
    padding-top: 0.5rem; /* py-2 */
    padding-bottom: 0.5rem;
    border-radius: 9999px; /* rounded-full */
    border: 1px solid rgba(255, 255, 255, 0.5); /* border border-white/50 */
    transition: background-color 0.2s; /* duration-200 */
    display: block; /* Agar bisa pakai text-center dan full width */
}
.card-action-link:hover {
    background-color: rgba(255, 255, 255, 0.2); /* hover:bg-white/20 */
}
.card-action-link i {
    margin-left: 0.25rem;
}

/* --- FILTER & SEARCH SECTION --- */
.filter-section {
    background-color: white;
    padding: 1.5rem; /* p-6 */
    border-radius: 0.75rem; /* rounded-xl */
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* card-shadow-xl */
}
.filter-section h2 {
    font-size: 1.25rem; /* text-xl */
    font-weight: 800; /* font-extrabold */
    color: var(--color-text-dark);
    margin-bottom: 1.25rem; /* mb-5 */
    display: flex;
    align-items: center;
}
.filter-section h2 i {
    color: #2563eb; /* text-blue-600 */
    margin-right: 0.5rem;
}

/* Search Bar */
.search-container {
    position: relative;
    width: 100%;
    margin-bottom: 1.5rem; /* mb-6 */
}
.search-input {
    border: 2px solid var(--color-border);
    border-radius: 0.75rem; /* rounded-xl */
    padding: 0.75rem 1.25rem; /* py-3 px-5 */
    padding-left: 3.5rem; /* pl-14 */
    font-size: 1rem; /* text-base */
    width: 100%;
    transition: all 0.15s ease; /* duration-150 */
    color: var(--color-text-dark);
    font-weight: 500; /* font-medium */
    
}
.search-input:focus {
    outline: none;
    border-color: #2563eb; /* focus:border-blue-600 */
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2); /* focus:ring-4 focus:ring-blue-200 */
}
.search-icon {
    position: absolute;
    left: 1.25rem; /* left-5 */
    top: 50%;
    transform: translateY(-50%);
    width: 1.25rem; /* w-5 */
    height: 1.25rem; /* h-5 */
    color: #9ca3af; /* text-gray-400 */
}

/* Filter Group */
.filter-group {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
    gap: 1.5rem; /* gap-6 */
}
@media (min-width: 768px) {
    .filter-group {
        grid-template-columns: repeat(3, minmax(0, 1fr)); /* md:grid-cols-3 */
    }
}

.filter-label {
    display: block;
    font-size: 0.875rem; /* text-sm */
    font-weight: 600; /* font-semibold */
    color: var(--color-text-medium);
    margin-bottom: 0.5rem; /* mb-2 */
}
.filter-select, .filter-input-date {
    margin-top: 0.25rem; /* mt-1 */
    display: block;
    width: 100%;
    padding: 0.75rem 1rem; /* py-3 pl-4 */
    padding-right: 2.5rem; /* pr-10 */
    font-size: 1rem; /* text-base */
    border: 2px solid var(--color-border);
    border-radius: 0.75rem; /* rounded-xl */
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
    transition: border-color 0.15s, box-shadow 0.15s;
}
.filter-select:focus, .filter-input-date:focus {
    outline: none;
    border-color: #2563eb; /* focus:border-blue-600 */
    box-shadow: 0 0 0 1px #2563eb, 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* focus:ring-blue-600 */
}
.date-input-group {
    display: flex;
    align-items: center;
    gap: 0.75rem; /* space-x-3 */
}
.reset-date-btn {
    margin-top: 0.25rem; /* mt-1 */
    flex-shrink: 0;
    padding: 0.75rem; /* p-3 */
    font-size: 1rem; /* text-base */
    background-color: #e5e7eb; /* bg-gray-200 */
    border-radius: 0.75rem; /* rounded-xl */
    transition: background-color 0.15s;
    color: var(--color-text-medium);
    border: none;
}
.reset-date-btn:hover {
    background-color: #d1d5db; /* hover:bg-gray-300 */
}

/* --- TABLE SECTION --- */
.table-section-wrapper {
    background-color: white;
    border-radius: 0.75rem; /* rounded-xl */
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* card-shadow-xl */
    overflow: hidden;
}

.table-title-bar {
    background-color: var(--color-primary);
    padding: 1.25rem 1.5rem; /* py-5 px-6 */
    text-align: center;
}
.table-title-bar h2 {
    font-size: 1.5rem; /* text-2xl */
    font-weight: 800; /* font-extrabold */
    color: white;
    letter-spacing: 0.025em; /* tracking-wider */
    margin: 0;
}
.table-title-bar h2 i {
    margin-left: 0.5rem;
}
@media (max-width: 767px) {
    .table-title-bar h2 {
        font-size: 1.25rem; /* md:text-2xl */
    }
}

.table-scroll-container {
    overflow-x: auto;
    max-height: 24rem; /* max-h-96 */
}

.data-table {
    min-width: 100%;
    border-collapse: collapse; /* table-auto */
}

/* Table Header */
.data-table thead tr {
    color: var(--color-text-medium);
    background-color: #e5e7eb; /* bg-gray-200 */
    border-bottom: 2px solid var(--color-border);
    text-transform: uppercase;
    font-size: 0.75rem; /* text-xs */
    letter-spacing: 0.05em; /* tracking-wider */
}
.data-table th {
    padding: 0.75rem 1rem; /* px-4 py-3 */
    text-align: left;
    font-weight: 700; /* font-bold */
    white-space: nowrap;
    /* Sticky Header */
    position: sticky;
    top: 0;
    z-index: 20;
    background-color: #e5e7eb; /* Match header row bg */
}
.data-table th.text-center {
    text-align: center;
}

/* Sticky Columns */
.sticky-col { 
    position: sticky; 
    left: 0; 
    z-index: 10; 
    border-right: 1px solid var(--color-border); /* border-r border-gray-300/200 */
}
.sticky-action { 
    position: sticky; 
    right: 0; 
    z-index: 10; 
    border-left: 1px solid var(--color-border); /* border-l border-gray-300/200 */
}

/* Sticky Header Adjustment */
.sticky-col.header, .sticky-action.header { 
    background-color: #E5E7EB; 
    z-index: 20; /* Lebih tinggi dari body sticky */
}

/* Table Body Rows */
.data-table tr {
    transition: background-color 0.15s; /* duration-150 */
}
.data-table tr:hover {
    background-color: #eff6ff; /* hover:bg-blue-50 */
}

/* Warna Latar Baris Ganjil-Genap (Zebra Stripping) */
.data-table tr:nth-child(odd) { background-color: #F9FAFB; } /* bg-odd-row (bg-gray-50) */
.data-table tr:nth-child(even) { background-color: #FFFFFF; } /* bg-even-row */

/* Sticky Column Adjustments for zebra stripping */
.data-table tr:nth-child(odd) .sticky-col,
.data-table tr:nth-child(odd) .sticky-action { background-color: #F9FAFB; }
.data-table tr:nth-child(even) .sticky-col,
.data-table tr:nth-child(even) .sticky-action { background-color: #FFFFFF; }

/* Sesuaikan warna header modal agar mirip dengan gambar */
.modal-header {
    background-color: #0b5394 !important; /* Biru tua untuk header */
}

/* Sesuaikan warna tombol aksi (jika Anda tidak menggunakan utility class Bootstrap) */
/* Contoh untuk tombol Tangguhkan dan Kembali jika ingin spesifik */
.btn-tangguhkan {
    background-color: #4a6fa5;
    border-color: #4a6fa5;
    color: white;
}

.btn-kembali {
    background-color: #1c1f33;
    border-color: #1c1f33;
    color: white;
}

/* Jika Anda ingin detail info box lebih rapi */
.detail-info-box p {
    margin-bottom: 0.5rem; /* Tambahkan sedikit jarak antar baris */
}

/* Table Cells */
.data-table td {
    padding: 1rem; /* px-4 py-4 */
    border-bottom: 1px solid #e5e7eb; /* border-b border-gray-200 */
    font-size: 0.875rem; /* text-sm */
    white-space: nowrap;
    color: var(--color-text-medium);
}
.data-table td.text-center {
    text-align: center;
}
.data-table td.font-semibold {
    font-weight: 600;
    color: var(--color-text-dark);
}
.data-table td .sticky-col {
    font-weight: 500;
    color: #4b5563;
}

/* Status Badges */
.status-badge {
    display: inline-block;
    padding: 0.25rem 1rem; /* py-1 px-4 */
    font-size: 0.75rem; /* text-xs */
    font-weight: 700; /* font-bold */
    color: white;
    border-radius: 9999px; /* rounded-full */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06); /* shadow-lg */
}

.status-badge.pending {
    background-color: #dc2626; /* bg-red-600 */
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: .5; }
}

.status-badge.disetujui {
    background-color: #059669; /* bg-green-600 */
}

.status-badge.ditolak {
    background-color: #6b7280; /* bg-gray-500 */
}

/* Action Buttons */
.action-btn {
    display: inline-block;
    background-color: #2563eb; /* bg-blue-600 */
    border-radius: 9999px; /* rounded-full */
    padding: 0.25rem 0.75rem; /* px-3 py-1 */
    color: white;
    font-size: 0.75rem; /* text-xs */
    font-weight: 600; /* font-semibold */
    transition: background-color 0.15s;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-md */
    text-decoration: none;
}
.action-btn i {
    margin-right: 0.25rem;
}
.action-btn.red {
    background-color: #dc2626; /* bg-red-600 */
}
.action-btn.blue:hover {
    background-color: #1d4ed8; /* hover:bg-blue-700 */
}
.action-btn.red:hover {
    background-color: #b91c1c; /* hover:bg-red-700 */
}
.action-btn.disabled {
    background-color: #9ca3af; /* bg-gray-400 */
    cursor: not-allowed;
}

/* Footer Info */
.table-footer {
    text-align: center;
    color: #4b5563; /* text-gray-600 */
    font-size: 0.875rem; /* text-sm */
    padding-top: 1rem; /* py-4 */
    padding-bottom: 1rem;
    background-color: #f9fafb; /* bg-gray-50 */
    border-top: 1px solid #e5e7eb; /* border-t border-gray-200 */
}
    </style>
</head>
<body>

    <div class="dashboard-container">
        
        <main class="main-content">
            
            <div>
                <h1 class="h1-title">
                    <i class="fas fa-clipboard-check"></i>
                    RINGKASAN PERSETUJUAN
                </h1>
            </div>

            <hr class="section-divider">
            
            {{-- ## Dashboard Cards (Fokus pada Aksi Cepat) --}}
            <div class="card-grid">
                
                {{-- Card 1: Perlu Persetujuan (Mendesak - Danger) --}}
                <div data-filter="pending" class="action-card bg-card-danger card-shadow-xl card-hover-pop">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">PERLU TINDAK LANJUT</h3>
                            <p class="card-value">3</p> 
                            <span class="card-subtitle">Permohonan menunggu review</span>
                        </div>
                        <div class="card-icon-wrapper">
                            <i class="fas fa-gavel"></i>
                        </div>
                    </div>
                    <p class="card-action-link">
                        Klik untuk Tinjau <i class="fas fa-arrow-right"></i>
                    </p>
                </div>

                {{-- Card 2: Peminjaman Aktif (Primary) --}}
                <div data-filter="disetujui" class="action-card bg-card-primary card-shadow-xl card-hover-pop">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">PEMINJAMAN AKTIF</h3>
                            <p class="card-value">60</p>
                            <span class="card-subtitle">Total aset sedang digunakan</span>
                        </div>
                        <div class="card-icon-wrapper">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                    </div>
                    <p class="card-action-link">
                        Klik untuk Lihat Semua <i class="fas fa-arrow-right"></i>
                    </p>
                </div>

                {{-- Card 3: Keterlambatan Pengembalian (Warning) --}}
                <div data-filter="terlambat" class="action-card bg-card-warning card-shadow-xl card-hover-pop">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">KETERLAMBATAN</h3>
                            <p class="card-value">5</p>
                            <span class="card-subtitle">Aset yang *overdue*</span>
                        </div>
                        <div class="card-icon-wrapper">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <p class="card-action-link">
                        Klik untuk Peringatan <i class="fas fa-arrow-right"></i>
                    </p>
                </div>

                {{-- Card 4: Total Disetujui (Success) --}}
                <div data-filter="disetujui-bulan-ini" class="action-card bg-card-success card-shadow-xl card-hover-pop">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">DISETUJUI (BULAN INI)</h3>
                            <p class="card-value">15</p>
                            <span class="card-subtitle">Permintaan berhasil disetujui</span>
                        </div>
                        <div class="card-icon-wrapper">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                    </div>
                    <p class="card-action-link">
                        Klik untuk Histori <i class="fas fa-arrow-right"></i>
                    </p>
                </div>
            </div>

            <hr class="section-divider">

            {{-- ## Filter dan Pencarian Canggih --}}
            <div class="filter-section">
                <h2>
                    <i class="fas fa-sliders-h"></i> Pengaturan Tampilan & Pencarian
                </h2>
                
                {{-- Search Bar --}}
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="CARI BERDASARKAN NIP, NAMA PEMINJAM, NAMA ASET..."
                            class="search-input">
                    <i class="fas fa-search search-icon"></i>
                </div>

                {{-- Filter Group --}}
                <div class="filter-group">
                    
                    {{-- Filter Status (Ditargetkan oleh Card) --}}
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
                            <input type="date" id="filter-start-date" class="filter-input-date">
                            <button type="button" id="reset-start-date" class="reset-date-btn" title="Reset Tanggal Mulai">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Tanggal Selesai --}}
                    <div>
                        <label for="filter-end-date" class="filter-label">Tanggal Akhir Peminjaman</label>
                        <div class="date-input-group">
                            <input type="date" id="filter-end-date" class="filter-input-date">
                            <button type="button" id="reset-end-date" class="reset-date-btn" title="Reset Tanggal Akhir">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="section-divider">

            {{-- ## Tabel Permohonan Peminjaman Aset --}}
            <div class="table-section-wrapper" id="permohonan-table-section">
                <div class="table-title-bar">
                    <h2>
                        DAFTAR PERMOHONAN ASET BARU <i class="fas fa-list-alt"></i>
                    </h2>
                </div>
                
                {{-- Kontainer Tabel yang Dapat Di-scroll Horizontal --}}
                <div class="table-scroll-container">
                    <table class="data-table" id="permohonan-table">
                        <thead>
                            <tr>
                                <th class="sticky-col header text-center border-r">NO</th>
                                <th class="">Tanggal Peminjaman</th>
                                <th class="">NIP</th>
                                <th class="">Nama Peminjam</th>
                                <th class="">Nama Aset</th>
                                <th class="">Unit</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Status</th>
                                <th class="sticky-action header text-center border-l">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            {{-- Row 1: Disetujui (Ganjil) --}}                            
                            <tr data-status-val="disetujui" data-date="2025-09-14">
                                <td class="sticky-col text-center border-r">1</td>
                                <td class="">14/09/2025</td>
                                <td class="" data-col="nip">123456789</td>
                                <td class="font-semibold" data-col="nama">Andi Purnomo</td>
                                <td class="" data-col="aset">Laptop ASUS ROG</td>
                                <td class="" data-col="unit">IT Dept.</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <span class="status-badge disetujui">
                                        Disetujui
                                    </span>
                                </td>
                                <td class="sticky-action text-center border-l">
                                    <a href="#" class="action-btn blue">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            
                            {{-- Row 2: Pending (Genap) - Target Utama Pimpinan --}}
                            <tr data-status-val="pending" data-date="2025-09-20">
                                <td class="sticky-col text-center border-r">2</td>
                                <td class="">20/09/2025</td>
                                <td class="" data-col="nip">987654321</td>
                                <td class="font-semibold" data-col="nama">Budi Santoso</td>
                                <td class="" data-col="aset">Proyektor EPSON</td>
                                <td class="" data-col="unit">HRD</td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <span class="status-badge pending">
                                        Pending
                                    </span>
                                </td>
                                <td class="sticky-action text-center border-l">
                                    <a href="#" class="action-btn red">
                                        <i class="fas fa-file-signature"></i> Tindak Lanjut
                                    </a>
                                </td>
                            </tr>

                            {{-- Row 3: Ditolak (Ganjil) --}}
                            <tr data-status-val="ditolak" data-date="2025-09-22">
                                <td class="sticky-col text-center border-r">3</td>
                                <td class="">22/09/2025</td>
                                <td class="" data-col="nip">555444333</td>
                                <td class="font-semibold" data-col="nama">Citra Dewi</td>
                                <td class="" data-col="aset">Kamera DSLR</td>
                                <td class="" data-col="unit">Marketing</td>
                                <td class="text-center" data-col="jumlah">2</td>
                                <td class="text-center">
                                    <span class="status-badge ditolak">
                                        Ditolak
                                    </span>
                                </td>
                               <td class="sticky-action text-center border-l">
    <a href="#" class="action-btn" data-bs-toggle="modal" data-bs-target="#detailPerbaikanModal">
        <i class="fas fa-eye"></i> Detail
    </a>
</td>
                            </tr>

                            {{-- Tambahkan baris data dummy lainnya di sini dengan atribut data-status-val dan data-date --}}
                            {{-- ... --}}
                            
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span id="display-row-count">Menampilkan 3 dari 3 Permohonan Baru.</span>
                </div>
            </div>
        </main>
    </div>

    {{-- Script untuk Fungsionalitas Filter dan Card Click (TETAP SAMA) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('filter-status');
            const startDateInput = document.getElementById('filter-start-date');
            const endDateInput = document.getElementById('filter-end-date');
            const tableBody = document.querySelector('#permohonan-table tbody');
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
                    
                    // 1. Filter Pencarian Teks (NIP, Nama, Aset)
                    if (searchKeyword) {
                        // Ambil data-col yang relevan untuk pencarian: nama, nip, aset
                        const nip = row.querySelector('[data-col="nip"]')?.textContent.toLowerCase() || '';
                        const nama = row.querySelector('[data-col="nama"]')?.textContent.toLowerCase() || '';
                        const aset = row.querySelector('[data-col="aset"]')?.textContent.toLowerCase() || '';
                        const unit = row.querySelector('[data-col="unit"]')?.textContent.toLowerCase() || '';

                        if (!nip.includes(searchKeyword) && !nama.includes(searchKeyword) && !aset.includes(searchKeyword) && !unit.includes(searchKeyword)) {
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

    <div class="modal fade" id="detailPerbaikanModal" tabindex="-1" aria-labelledby="detailPerbaikanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0b5394;"> 
                <h5 class="modal-title" id="detailPerbaikanModalLabel">Detail Pengajuan Perbaikan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-7"> 
                        <div class="detail-info-box border p-3 rounded">
                            <p><strong>Tanggal pengajuan</strong> : 01/09/2025</p>
                            <p><strong>Nama Barang</strong> : Kursi</p>
                            <p><strong>Kode Barang</strong> : BR-1002</p>
                            <p><strong>Jenis Barang</strong> : Furniture</p>
                            <p><strong>Jenis Kerusakan</strong> : Patah</p>
                            <p><strong>Keterangan tambahan</strong> : -</p>
                            <p><strong>Upload Foto Kerusakan</strong> : -</p>
                        </div>
                    </div>

                    <div class="col-md-5 d-grid gap-2">
                        <button type="button" class="btn btn-success btn-lg">Setujui</button>
                        <button type="button" class="btn btn-danger btn-lg">Tolak</button>
                        <button type="button" class="btn btn-primary btn-lg" style="background-color: #4a6fa5; border-color: #4a6fa5;">Tangguhkan</button>
                        <button type="button" class="btn btn-dark btn-lg" data-bs-dismiss="modal" style="background-color: #1c1f33; border-color: #1c1f33;">Kembali</button>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="catatan" class="form-label"><strong>Catatan:</strong></label>
                    <textarea class="form-control" id="catatan" rows="3"></textarea>
                </div>
            </div>
            
        </div>
    </div>
</div>
</body>
</html>
@endsection