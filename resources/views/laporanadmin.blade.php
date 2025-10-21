@extends('layouts.main')

@section('content')

<div>
    <style>
        .page-subheader-card {
            background-color: #0b4f8c;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }
        .card {
            margin-top: 0; 
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        #reportMenu {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 0 0 8px 8px;
            border-top: 1px solid #e0e0e0;
        }
        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 20px;
        }
        .report-card {
            background-color: #f7f9fb;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .report-card:hover, .report-card.active {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-color: #0b4f8c;
        }
        .report-card.active {
            background-color: #e6f0f7; 
        }
        .report-title { font-weight: 600; color: #0b4f8c; margin-top: 5px; }
        .report-icon { font-size: 30px; color: #0b4f8c; }

        #reportDetailContainer {
            margin-top: 20px;
        }
        .report-detail-box {
            display: none; 
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #ffffff;
            animation: fadeIn 0.5s; 
        }
        .report-detail-box.active {
            display: block; 
        }

        .filter-section {
            display: flex;
            flex-wrap: wrap; 
            gap: 20px;
            margin-bottom: 20px;
            align-items: flex-end;
        }
        .filter-group { flex-grow: 1; min-width: 180px; }
        .filter-group label { display: block; margin-bottom: 5px; font-weight: 500;}
        .filter-group input, .filter-group select { 
            padding: 8px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            width: 100%; 
            box-sizing: border-box; 
        }
        .btn-laporan { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; transition: background-color 0.2s; }
        .btn-tampilkan { background-color: #0b4f8c; color: white; }
        .btn-tampilkan:hover { background-color: #083c6b; }
        .btn-action-group { display: flex; align-items: flex-end; }
        .btn-action-group button { margin-left: 10px; }
        
        .report-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
 
        .btn-cetak { background-color: #6c757d; color: white; }
        .btn-cetak:hover { background-color: #5a6268; }
        .btn-excel { background-color: #28a745; color: white; }
        .btn-excel:hover { background-color: #1e7e34; }

        .report-table-section { margin-top: 20px; overflow-x: auto; }
        .report-table { width: 100%; border-collapse: collapse; }
        .report-table th, .report-table td { 
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: left; 
        }
        .report-table thead th { 
            background-color: #f1f1f1; 
            font-weight: 600; 
            color: #333;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    
    {{-- PASTIKAN ICON FONT-AWESOME SUDAH TERSEDIA DI LAYOUT UTAMA ('layouts.main') --}}

    {{-- HEADER UTAMA --}}
    <div class="card">
        <div class="page-subheader-card">
            <h4 class="mb-0">Pusat Laporan Inventaris</h4> 
        </div>

        {{-- AREA MENU PILIHAN LAPORAN (CARD GRID) --}}
        <div id="reportMenu">
            <h5 style="margin-bottom: 15px;">Pilih Jenis Laporan:</h5>
            <div class="report-grid">
                
                {{-- Tambahkan data-target untuk JS --}}
                <div class="report-card active" data-target="data_aset">
                    <i class="fas fa-clipboard-list report-icon"></i> 
                    <div class="report-title">Data Aset</div>
                </div>

                <div class="report-card" data-target="barang_masuk">
                    <i class="fas fa-file-import report-icon"></i>
                    <div class="report-title">Barang Masuk</div>
                </div>

                <div class="report-card" data-target="barang_keluar">
                    <i class="fas fa-file-export report-icon"></i>
                    <div class="report-title">Barang Keluar</div>
                </div>
                
                <div class="report-card" data-target="perbaikan">
                    <i class="fas fa-tools report-icon"></i>
                    <div class="report-title">Pengajuan Perbaikan</div>
                </div>

                <div class="report-card" data-target="pembelian">
                    <i class="fas fa-shopping-cart report-icon"></i>
                    <div class="report-title">Pembelian Sparepart</div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- AREA DETAIL LAPORAN TUNGGAL --}}
    <div id="reportDetailContainer">

        {{-- LAPORAN 1: DATA ASET --}}
        <div class="report-detail-box active" id="detail_data_aset">
            <h3>Laporan Data Seluruh Aset</h3>
            
            <form class="filter-section" id="filter_data_aset">
                <div class="filter-group">
                    <label for="aset_status">Filter Status Aset:</label>
                    <select id="aset_status">
                        <option value="">Semua Status</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                        <option value="Perbaikan">Perbaikan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="aset_kategori">Filter Kategori:</label>
                    <select id="aset_kategori">
                        <option value="">Semua Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Furnitur">Furnitur</option>
                        <option value="Kendaraan">Kendaraan</option>
                    </select>
                </div>
                <div class="btn-action-group">
                    <button type="button" class="btn-laporan btn-tampilkan" data-report-name="Data Aset">Tampilkan Laporan</button>
                </div>
            </form>

            <div class="report-controls">
                <p>Total Aset: <strong id="total_aset">...</strong></p>
                <div class="btn-action-group">
                    <button class="btn-laporan btn-excel" data-report-name="Data Aset">Export ke Excel</button>
                    <button class="btn-laporan btn-cetak" data-report-name="Data Aset">Cetak</button>
                </div>
            </div>
            
            <div class="report-table-section">
                {{-- Tabel Data Aset (Header Saja) --}}
                <table class="report-table" id="table_data_aset">
                    <thead><tr><th>Kode</th><th>Nama Aset</th><th>Kategori</th><th>Status</th><th>Lokasi</th></tr></thead>
                    <tbody><tr><td colspan="5" style="text-align: center; color:#999;">Isi filter dan klik 'Tampilkan Laporan' untuk memuat data.</td></tr></tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN 2: BARANG MASUK --}}
        <div class="report-detail-box" id="detail_barang_masuk">
            <h3>Laporan Barang Masuk</h3>
            
            <form class="filter-section" id="filter_barang_masuk">
                <div class="filter-group">
                    <label for="masuk_start_date">Tanggal Mulai:</label>
                    <input type="date" id="masuk_start_date">
                </div>
                <div class="filter-group">
                    <label for="masuk_end_date">Tanggal Selesai:</label>
                    <input type="date" id="masuk_end_date">
                </div>
                <div class="btn-action-group">
                    <button type="button" class="btn-laporan btn-tampilkan" data-report-name="Barang Masuk">Tampilkan Laporan</button>
                </div>
            </form>
            
            <div class="report-controls">
                <p>Total Item Masuk (Periode): <strong id="total_masuk">...</strong></p>
                <div class="btn-action-group">
                    <button class="btn-laporan btn-excel" data-report-name="Barang Masuk">Export ke Excel</button>
                    <button class="btn-laporan btn-cetak" data-report-name="Barang Masuk">Cetak</button>
                </div>
            </div>

            <div class="report-table-section">
                {{-- Tabel Barang Masuk (Header Saja) --}}
                <table class="report-table" id="table_barang_masuk">
                    <thead><tr><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Sumber</th><th>Keterangan</th></tr></thead>
                    <tbody><tr><td colspan="5" style="text-align: center; color:#999;">Isi filter dan klik 'Tampilkan Laporan' untuk memuat data.</td></tr></tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN 3: BARANG KELUAR --}}
        <div class="report-detail-box" id="detail_barang_keluar">
            <h3>Laporan Barang Keluar</h3>
            
            <form class="filter-section" id="filter_barang_keluar">
                <div class="filter-group">
                    <label for="keluar_start_date">Tanggal Mulai:</label>
                    <input type="date" id="keluar_start_date">
                </div>
                <div class="filter-group">
                    <label for="keluar_end_date">Tanggal Selesai:</label>
                    <input type="date" id="keluar_end_date">
                </div>
                <div class="btn-action-group">
                    <button type="button" class="btn-laporan btn-tampilkan" data-report-name="Barang Keluar">Tampilkan Laporan</button>
                </div>
            </form>
            
            <div class="report-controls">
                <p>Total Item Keluar (Periode): <strong id="total_keluar">...</strong></p>
                <div class="btn-action-group">
                    <button class="btn-laporan btn-excel" data-report-name="Barang Keluar">Export ke Excel</button>
                    <button class="btn-laporan btn-cetak" data-report-name="Barang Keluar">Cetak</button>
                </div>
            </div>

            <div class="report-table-section">
                {{-- Tabel Barang Keluar (Header Saja) --}}
                <table class="report-table" id="table_barang_keluar">
                    <thead><tr><th>Tanggal</th><th>Nama Barang</th><th>Jumlah</th><th>Tujuan</th><th>Penerima</th></tr></thead>
                    <tbody><tr><td colspan="5" style="text-align: center; color:#999;">Isi filter dan klik 'Tampilkan Laporan' untuk memuat data.</td></tr></tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN 4: PENGAJUAN PERBAIKAN --}}
        <div class="report-detail-box" id="detail_perbaikan">
            <h3>Laporan Pengajuan Perbaikan</h3>
            
            <form class="filter-section" id="filter_perbaikan">
                <div class="filter-group">
                    <label for="perbaikan_status">Status Perbaikan:</label>
                    <select id="perbaikan_status">
                        <option value="">Semua Status</option>
                        <option value="Diajukan">Diajukan</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="perbaikan_start_date">Tanggal Mulai Pengajuan:</label>
                    <input type="date" id="perbaikan_start_date">
                </div>
                <div class="filter-group">
                    <label for="perbaikan_end_date">Tanggal Selesai Pengajuan:</label>
                    <input type="date" id="perbaikan_end_date">
                </div>
                <div class="btn-action-group">
                    <button type="button" class="btn-laporan btn-tampilkan" data-report-name="Pengajuan Perbaikan">Tampilkan Laporan</button>
                </div>
            </form>
            
            <div class="report-controls">
                <p>Total Pengajuan (Periode): <strong id="total_perbaikan">...</strong></p>
                <div class="btn-action-group">
                    <button class="btn-laporan btn-excel" data-report-name="Pengajuan Perbaikan">Export ke Excel</button>
                    <button class="btn-laporan btn-cetak" data-report-name="Pengajuan Perbaikan">Cetak</button>
                </div>
            </div>

            <div class="report-table-section">
                {{-- Tabel Pengajuan Perbaikan (Header Saja) --}}
                <table class="report-table" id="table_perbaikan">
                    <thead><tr><th>No. Ajuan</th><th>Aset</th><th>Tgl. Ajuan</th><th>Deskripsi</th><th>Status</th></tr></thead>
                    <tbody><tr><td colspan="5" style="text-align: center; color:#999;">Isi filter dan klik 'Tampilkan Laporan' untuk memuat data.</td></tr></tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN 5: PEMBELIAN SPAREPART --}}
        <div class="report-detail-box" id="detail_pembelian">
            <h3>Laporan Pembelian Sparepart</h3>
            
            <form class="filter-section" id="filter_pembelian">
                <div class="filter-group">
                    <label for="pembelian_start_date">Tanggal Mulai Pembelian:</label>
                    <input type="date" id="pembelian_start_date">
                </div>
                <div class="filter-group">
                    <label for="pembelian_end_date">Tanggal Selesai Pembelian:</label>
                    <input type="date" id="pembelian_end_date">
                </div>
                <div class="btn-action-group">
                    <button type="button" class="btn-laporan btn-tampilkan" data-report-name="Pembelian Sparepart">Tampilkan Laporan</button>
                </div>
            </form>
            
            <div class="report-controls">
                <p>Total Pembelian (Transaksi): <strong id="total_pembelian">...</strong></p>
                <div class="btn-action-group">
                    <button class="btn-laporan btn-excel" data-report-name="Pembelian Sparepart">Export ke Excel</button>
                    <button class="btn-laporan btn-cetak" data-report-name="Pembelian Sparepart">Cetak</button>
                </div>
            </div>

            <div class="report-table-section">
                {{-- Tabel Pembelian Sparepart (Header Saja) --}}
                <table class="report-table" id="table_pembelian">
                    <thead><tr><th>Tgl. Beli</th><th>Nama Sparepart</th><th>Jumlah</th><th>Harga Satuan</th><th>Total</th></tr></thead>
                    <tbody><tr><td colspan="5" style="text-align: center; color:#999;">Isi filter dan klik 'Tampilkan Laporan' untuk memuat data.</td></tr></tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuCards = document.querySelectorAll('#reportMenu .report-card');
    const detailBoxes = document.querySelectorAll('.report-detail-box');
    
    function showReportDetail(targetId) {
        detailBoxes.forEach(box => {
            box.classList.remove('active');
        });

        const targetElement = document.getElementById('detail_' + targetId);
        if (targetElement) {
            targetElement.classList.add('active');
        }
    }

    menuCards.forEach(card => {
        card.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            menuCards.forEach(mc => mc.classList.remove('active'));
            this.classList.add('active');
            showReportDetail(target);
            document.getElementById('reportDetailContainer').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    const btnTampilkan = document.querySelectorAll('.btn-tampilkan');
    btnTampilkan.forEach(button => {
        button.addEventListener('click', function() {
            const reportName = this.getAttribute('data-report-name');
            
            if (reportName === 'Data Aset') {
                document.getElementById('total_aset').textContent = '120'; 

                const tableBody = document.querySelector('#table_data_aset tbody');
                tableBody.innerHTML = `
                    <tr><td>A001</td><td>Laptop Thinkpad</td><td>Elektronik</td><td>Tersedia</td><td>Ruang IT</td></tr>
                    <tr><td>A002</td><td>Meja Kerja</td><td>Furnitur</td><td>Dipinjam</td><td>Ruang Manager</td></tr>
                    <tr><td>A003</td><td>AC Split 1PK</td><td>Elektronik</td><td>Perbaikan</td><td>Gudang</td></tr>
                `;
            } else if (reportName === 'Barang Masuk') {
                document.getElementById('total_masuk').textContent = '25 Item'; 
                const tableBody = document.querySelector('#table_barang_masuk tbody');
                tableBody.innerHTML = `
                    <tr><td>2025-10-01</td><td>Kertas A4</td><td>100 Rim</td><td>Pembelian</td><td>Dari Supplier C</td></tr>
                    <tr><td>2025-10-05</td><td>Mouse Logi</td><td>10 Pcs</td><td>Donasi</td><td>Hibah Kantor Pusat</td></tr>
                `;
            } 
            // Anda bisa menambahkan logika pemuatan data untuk laporan lainnya di sini
        });
    });

    const btnExcel = document.querySelectorAll('.btn-excel');
    btnExcel.forEach(button => {
        button.addEventListener('click', function() {
            console.log(`Export ke Excel untuk Laporan ${reportName}`); 
        });
    });

    const btnCetak = document.querySelectorAll('.btn-cetak');
    btnCetak.forEach(button => {
        button.addEventListener('click', function() {
            const reportName = this.getAttribute('data-report-name');
            console.log(`Membuka dialog cetak untuk Laporan ${reportName}`); 
        });
    });

    const initialTarget = document.querySelector('.report-card.active').getAttribute('data-target');
    showReportDetail(initialTarget);

    document.querySelector('#detail_data_aset .btn-tampilkan').click();
});
</script>
@endsection