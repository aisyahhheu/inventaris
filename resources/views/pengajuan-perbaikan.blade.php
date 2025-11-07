@extends('layouts.pimpinan')

@section('title', 'Dashboard Persetujuan Peminjaman Aset')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan - Persetujuan Peminjaman</title>
    {{-- Memuat Tailwind CSS & Font Awesome --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Palet Warna Kustom (Lebih Profesional) */
        :root {
            --color-primary: #1E3A8A; /* Biru Gelap (Kontrol) */
            --color-danger: #DC2626; /* Merah (Aksi Mendesak) */
            --color-warning: #D97706; /* Kuning/Oranye (Peringatan) */
            --color-success: #059669; /* Hijau (Disetujui/Sukses) */
        }

        .bg-card-primary { background-color: var(--color-primary); }
        .bg-card-danger { background-color: var(--color-danger); }
        .bg-card-warning { background-color: var(--color-warning); }
        .bg-card-success { background-color: var(--color-success); }
        
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
        
        /* Warna Latar Baris Ganjil-Genap */
        .bg-odd-row { background-color: #F9FAFB; }
        .bg-even-row { background-color: #FFFFFF; }

        /* Sticky Columns */
        .sticky-col { position: sticky; left: 0; z-index: 10; }
        .sticky-action { position: sticky; right: 0; z-index: 10; }
        
        /* Sticky Column Adjustments for zebra stripping */
        tr:nth-child(odd) .sticky-col,
        tr:nth-child(odd) .sticky-action { background-color: #F9FAFB; }
        tr:nth-child(even) .sticky-col,
        tr:nth-child(even) .sticky-action { background-color: #FFFFFF; }

        /* Sticky Header Adjustment */
        th { position: sticky; top: 0; z-index: 20; background-color: #E5E7EB; }
        .sticky-col.header, .sticky-action.header { background-color: #E5E7EB; }

    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <main class="flex-1 overflow-y-auto p-4 md:p-10 space-y-10">
            
                    <div>
  <h1 class="text-2xl font-extrabold text-gray-800 mb-5 flex items-center">
    <i class="fas fa-clipboard-check text-blue-600 mr-2"></i>
    RINGKASAN PERSETUJUAN
  </h1>
</div>
            <hr class="border-gray-300">
            
            {{-- ## Dashboard Cards (Fokus pada Aksi Cepat) --}}
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                
                {{-- Card 1: Perlu Persetujuan (Mendesak - Danger) --}}
                <div data-filter="pending" class="action-card bg-card-danger text-white p-6 rounded-xl card-shadow-xl w-full card-hover-pop transition-all duration-300 cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-white/90 uppercase tracking-widest mb-1">PERLU TINDAK LANJUT</h3>
                            <p class="text-5xl font-extrabold mt-1">3</p> 
                            <span class="text-xs text-white/70">Permohonan menunggu review</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-gavel text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-center text-xs font-semibold uppercase py-2 rounded-full border border-white/50 hover:bg-white/20 transition duration-200">
                        Klik untuk Tinjau <i class="fas fa-arrow-right ml-1"></i>
                    </p>
                </div>

                {{-- Card 2: Peminjaman Aktif (Primary) --}}
                <div data-filter="disetujui" class="action-card bg-card-primary text-white p-6 rounded-xl card-shadow-xl w-full card-hover-pop transition-all duration-300 cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-white/90 uppercase tracking-widest mb-1">PEMINJAMAN AKTIF</h3>
                            <p class="text-5xl font-extrabold mt-1">60</p>
                            <span class="text-xs text-white/70">Total aset sedang digunakan</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exchange-alt text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-center text-xs font-semibold uppercase py-2 rounded-full border border-white/50 hover:bg-white/20 transition duration-200">
                        Klik untuk Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </p>
                </div>

                {{-- Card 3: Keterlambatan Pengembalian (Warning) --}}
                <div data-filter="terlambat" class="action-card bg-card-warning text-white p-6 rounded-xl card-shadow-xl w-full card-hover-pop transition-all duration-300 cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-white/90 uppercase tracking-widest mb-1">KETERLAMBATAN</h3>
                            <p class="text-5xl font-extrabold mt-1">5</p>
                            <span class="text-xs text-white/70">Aset yang *overdue*</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-center text-xs font-semibold uppercase py-2 rounded-full border border-white/50 hover:bg-white/20 transition duration-200">
                        Klik untuk Peringatan <i class="fas fa-arrow-right ml-1"></i>
                    </p>
                </div>

                {{-- Card 4: Total Disetujui (Success) --}}
                <div data-filter="disetujui-bulan-ini" class="action-card bg-card-success text-white p-6 rounded-xl card-shadow-xl w-full card-hover-pop transition-all duration-300 cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-white/90 uppercase tracking-widest mb-1">DISETUJUI (BULAN INI)</h3>
                            <p class="text-5xl font-extrabold mt-1">15</p>
                            <span class="text-xs text-white/70">Permintaan berhasil disetujui</span>
                        </div>
                        <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-thumbs-up text-white text-2xl"></i>
                        </div>
                    </div>
                    <p class="mt-4 text-center text-xs font-semibold uppercase py-2 rounded-full border border-white/50 hover:bg-white/20 transition duration-200">
                        Klik untuk Histori <i class="fas fa-arrow-right ml-1"></i>
                    </p>
                </div>
            </div>

            <hr class="border-gray-300">

            {{-- ## Filter dan Pencarian Canggih --}}
            <div class="bg-white p-6 rounded-xl card-shadow-xl">
                <h2 class="text-xl font-extrabold text-gray-800 mb-5 flex items-center">
                    <i class="fas fa-sliders-h text-blue-600 mr-2"></i> Pengaturan Tampilan & Pencarian
                </h2>
                
                {{-- Search Bar --}}
                <div class="relative w-full mb-6">
                    <input type="text" id="search-input" placeholder="CARI BERDASARKAN NIP, NAMA PEMINJAM, NAMA ASET..."
                            class="border-2 border-gray-300 rounded-xl px-5 py-3 text-base pl-14 w-full focus:ring-4 focus:ring-blue-200 focus:border-blue-600 transition duration-150 placeholder-gray-500 font-medium">
                    <i class="fas fa-search w-5 h-5 text-gray-400 absolute left-5 top-1/2 transform -translate-y-1/2"></i>
                </div>

                {{-- Filter Group --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Filter Status (Ditargetkan oleh Card) --}}
                    <div>
                        <label for="filter-status" class="block text-sm font-semibold text-gray-700 mb-2">Status Permohonan</label>
                        <select id="filter-status" class="mt-1 block w-full pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-600 focus:border-blue-600 rounded-xl border-2 shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending (Menunggu)</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                            {{-- Catatan: Status 'terlambat' dan 'disetujui-bulan-ini' akan menjadi logic tambahan di JS/Backend --}}
                        </select>
                    </div>

                    {{-- Filter Tanggal Mulai --}}
                    <div>
                        <label for="filter-start-date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Peminjaman</label>
                        <div class="flex items-center space-x-3">
                            <input type="date" id="filter-start-date" class="mt-1 block w-full pl-4 pr-4 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-600 focus:border-blue-600 rounded-xl border-2 shadow-sm">
                            <button type="button" id="reset-start-date" class="mt-1 flex-shrink-0 p-3 text-base bg-gray-200 rounded-xl hover:bg-gray-300 transition duration-150 text-gray-700" title="Reset Tanggal Mulai">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Tanggal Selesai --}}
                    <div>
                        <label for="filter-end-date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Akhir Peminjaman</label>
                        <div class="flex items-center space-x-3">
                            <input type="date" id="filter-end-date" class="mt-1 block w-full pl-4 pr-4 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-600 focus:border-blue-600 rounded-xl border-2 shadow-sm">
                            <button type="button" id="reset-end-date" class="mt-1 flex-shrink-0 p-3 text-base bg-gray-200 rounded-xl hover:bg-gray-300 transition duration-150 text-gray-700" title="Reset Tanggal Akhir">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="border-gray-300">

            {{-- ## Tabel Permohonan Peminjaman Aset --}}
            <div class="bg-white rounded-xl card-shadow-xl overflow-hidden" id="permohonan-table-section">
                <div class="bg-card-success">
                    <h2 class="text-xl md:text-2xl font-extrabold text-white py-5 px-6 text-center tracking-wider">
                        DAFTAR PERMOHONAN ASET BARU <i class="fas fa-list-alt ml-2"></i>
                    </h2>
                </div>
                
                {{-- Kontainer Tabel yang Dapat Di-scroll Horizontal --}}
                <div class="overflow-x-auto max-h-96">
                    <table class="min-w-full table-auto" id="permohonan-table">
                        <thead>
                            <tr class="text-gray-700 bg-gray-200 border-b-2 border-gray-300 uppercase text-xs tracking-wider">
                                <th class="sticky-col header px-4 py-3 text-center font-bold whitespace-nowrap border-r border-gray-300">NO</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Tanggal Peminjaman</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">NIP</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Nama Peminjam</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Nama Aset</th>
                                <th class="px-4 py-3 text-left font-bold whitespace-nowrap">Unit</th>
                                <th class="px-4 py-3 text-center font-bold whitespace-nowrap">Jumlah</th>
                                <th class="px-4 py-3 text-center font-bold whitespace-nowrap">Status</th>
                                <th class="sticky-action header px-4 py-3 text-center font-bold whitespace-nowrap border-l border-gray-300">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            {{-- Row 1: Disetujui (Ganjil) --}}                            
                            <tr class="bg-odd-row hover:bg-blue-50 transition duration-150" data-status-val="disetujui" data-date="2025-09-14">
                                <td class="sticky-col px-4 py-4 border-b border-gray-200 text-sm text-center font-medium text-gray-600 border-r border-gray-200">1</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700">14/09/2025</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="nip">123456789</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap font-semibold text-gray-800" data-col="nama">Andi Purnomo</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="aset">Laptop ASUS ROG</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="unit">IT Dept.</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center text-gray-700">1</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center whitespace-nowrap">
                                    <span class="inline-block px-4 py-1 text-xs font-bold text-white bg-green-600 rounded-full shadow-lg">
                                        Disetujui
                                    </span>
                                </td>
                                <td class="sticky-action px-4 py-4 border-b border-gray-200 text-sm text-center border-l border-gray-200">
                                    <a href="#" class="inline-block bg-blue-600 rounded-full px-3 py-1 text-white text-xs font-semibold hover:bg-blue-700 transition duration-150 shadow-md">
                                        <i class="fas fa-info-circle mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            
                            {{-- Row 2: Pending (Genap) - Target Utama Pimpinan --}}
                            <tr class="bg-even-row hover:bg-blue-50 transition duration-150" data-status-val="pending" data-date="2025-09-20">
                                <td class="sticky-col px-4 py-4 border-b border-gray-200 text-sm text-center font-medium text-gray-600 border-r border-gray-200">2</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700">20/09/2025</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="nip">987654321</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap font-semibold text-gray-800" data-col="nama">Budi Santoso</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="aset">Proyektor EPSON</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="unit">HRD</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center text-gray-700">1</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center whitespace-nowrap">
                                    <span class="inline-block px-4 py-1 text-xs font-bold text-white bg-red-600 rounded-full shadow-lg animate-pulse">
                                        Pending
                                    </span>
                                </td>
                                <td class="sticky-action px-4 py-4 border-b border-gray-200 text-sm text-center border-l border-gray-200">
                                    <a href="#" class="inline-block bg-red-600 rounded-full px-3 py-1 text-white text-xs font-semibold hover:bg-red-700 transition duration-150 shadow-md">
                                        <i class="fas fa-file-signature mr-1"></i> Tindak Lanjut
                                    </a>
                                </td>
                            </tr>

                            {{-- Row 3: Ditolak (Ganjil) --}}
                            <tr class="bg-odd-row hover:bg-blue-50 transition duration-150" data-status-val="ditolak" data-date="2025-09-22">
                                <td class="sticky-col px-4 py-4 border-b border-gray-200 text-sm text-center font-medium text-gray-600 border-r border-gray-200">3</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700">22/09/2025</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="nip">555444333</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap font-semibold text-gray-800" data-col="nama">Citra Dewi</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="aset">Kamera DSLR</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm whitespace-nowrap text-gray-700" data-col="unit">Marketing</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center text-gray-700" data-col="jumlah">2</td>
                                <td class="px-4 py-4 border-b border-gray-200 text-sm text-center whitespace-nowrap">
                                    <span class="inline-block px-4 py-1 text-xs font-bold text-white bg-gray-500 rounded-full shadow-lg">
                                        Ditolak
                                    </span>
                                </td>
                                <td class="sticky-action px-4 py-4 border-b border-gray-200 text-sm text-center border-l border-gray-200">
                                    <a href="#" class="inline-block bg-gray-400 rounded-full px-3 py-1 text-white text-xs font-semibold cursor-not-allowed transition duration-150 shadow-md">
                                        <i class="fas fa-times-circle mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>

                            {{-- Tambahkan baris data dummy lainnya di sini dengan atribut data-status-val dan data-date --}}
                            {{-- ... --}}
                            
                        </tbody>
                    </table>
                </div>
                <div class="text-center text-gray-600 text-sm py-4 bg-gray-50 border-t border-gray-200">
                    <span id="display-row-count">Menampilkan 3 dari 3 Permohonan Baru.</span>
                </div>
            </div>
        </main>
    </div>

    {{-- Script untuk Fungsionalitas Filter dan Card Click --}}
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
</body>
</html>
@endsection