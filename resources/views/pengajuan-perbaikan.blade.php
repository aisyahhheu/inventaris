@extends('layouts.main') {{-- Sesuaikan dengan nama layout utama Anda --}}

@section('content')

<style>
    /* ------------------------------------- */
    /* 1. STYLING UTAMA LAYOUT & KARTU */
    /* ------------------------------------- */
    .main-content {
        padding: 20px;
    }
    .header-halaman {
        margin-bottom: 20px;
    }
    .header-halaman h1 {
        font-size: 1.8em;
        margin: 0;
        color: #333;
    }
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Penting untuk header yang rounded */
    }
    .card-header {
        background-color: #0b4f8c; /* Warna biru sesuai desain */
        color: white;
        padding: 15px;
        border-bottom: none;
    }
    .card-header h3 {
        margin: 0;
        font-size: 1.5em;
    }
    .card-body {
        padding: 20px;
    }
    .card-body p {
        margin-bottom: 20px;
        color: #666;
    }

    /* ------------------------------------- */
    /* 2. STYLING TABEL */
    /* ------------------------------------- */
    #tabelPengajuanPerbaikan {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }
    #tabelPengajuanPerbaikan thead tr {
        background-color: #f1f1f1;
    }
    #tabelPengajuanPerbaikan th, 
    #tabelPengajuanPerbaikan td {
        padding: 12px 10px;
        text-align: left;
        border: 1px solid #ddd;
        vertical-align: middle;
        word-wrap: break-word; /* Mencegah kolom melebar tak terkontrol */
    }
    #tabelPengajuanPerbaikan th {
        font-weight: 600;
        color: #444;
    }
    
    /* ------------------------------------- */
    /* 3. STYLING STATUS BADGE & TOMBOL */
    /* ------------------------------------- */
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.85em;
        font-weight: bold;
        color: white;
        text-align: center;
    }
    /* Warna Status */
    .status-menunggu { background-color: #ffc107; color: #343a40; } /* Kuning */
    .status-disetujui { background-color: #28a745; } /* Hijau */
    .status-ditolak { background-color: #dc3545; } /* Merah */
    .status-diproses { background-color: #17a2b8; } /* Biru Muda */
    .status-selesai { background-color: #007bff; } /* Biru */

    .btn-detail {
        padding: 8px 12px;
        background-color: #0b4f8c; /* Biru */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s;
        font-size: 0.9em;
    }
    .btn-detail:hover {
        background-color: #083c6b;
    }
    
    /* ------------------------------------- */
    /* 4. STYLING MODAL (Sama seperti sebelumnya) */
    /* ------------------------------------- */
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgba(0,0,0,0.5); 
        padding-top: 60px;
    }
    .modal-content {
        background-color: #fefefe; 
        margin: 5% auto; 
        border: 1px solid #888;
        width: 90%; 
        max-width: 900px; 
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }
</style>

{{-- Konten Utama Halaman --}}
<div class="main-content">
    
    {{-- Header Halaman --}}
    <div class="header-halaman">
        <h1>Selamat Datang, Admin!</h1>
    </div>

    {{-- Judul dan Card Pembungkus --}}
    <div class="card">
        <div class="card-header">
            <h3>Pengajuan Perbaikan Aset</h3>
        </div>
        
        <div class="card-body">
            <p>Daftar aset yang diajukan untuk perbaikan oleh pegawai.</p>

            {{-- Baris ini menyimpan URL dasar untuk AJAX, sama seperti solusi sebelumnya --}}
            <div id="pengajuanCard" data-detail-url="{{ route('pemeliharaan.detail_perbaikan', ['id' => 'TEMP_ID']) }}"></div>

            <table id="tabelPengajuanPerbaikan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Diajukan Oleh</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Jenis Kerusakan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data dari Controller. Pastikan Controller mengirim variabel $pengajuan --}}
                    @forelse ($pengajuan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->kode_aset ?? '-' }}</td>
                            <td>{{ $data->nama_aset ?? '-' }}</td>
                            <td>{{ $data->nama_pegawai ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tgl_pengajuan)->format('d/m/Y') }}</td>
                            <td>{{ $data->jenis_kerusakan ?? 'Umum' }}</td>
                            <td>
                                {{-- Menetapkan kelas badge berdasarkan status data --}}
                                <span class="badge status-{{ strtolower(str_replace(' ', '', $data->status ?? 'menunggu')) }}">
                                    {{ $data->status ?? 'Menunggu' }}
                                </span>
                            </td>
                            <td>
                                <button 
                                    class="btn-detail" 
                                    data-id="{{ $data->id }}"
                                    onclick="tampilkanDetail(this)"
                                >
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 20px; color: #6c757d;">Tidak ada pengajuan perbaikan yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
    </div>
</div>

{{-- MODAL UNTUK DETAIL PENGAJUAN PERBAIKAN --}}
<div id="detailPengajuanModal" class="modal">
    <div class="modal-content">
        <div id="modal-body-content">
            {{-- Konten detail akan dimuat di sini oleh AJAX --}}
            <div style="text-align: center; padding: 50px;">Silakan klik "Lihat Detail" pada tabel.</div>
        </div>
    </div>
</div>

<script>
    // Fungsi JavaScript untuk menampilkan detail pengajuan perbaikan (menggunakan AJAX)
    function tampilkanDetailPengajuan(id) {
        // Implementasi AJAX untuk memuat konten modal_detail_perbaikan.blade.php
        const modal = document.getElementById('detailPengajuanModal');
        const modalBody = document.getElementById('modal-body-content');
        const card = document.getElementById('pengajuanCard');
        const baseUrl = card ? card.getAttribute('data-detail-url') : null;
        
        if (!baseUrl) {
            console.error('Error: Base URL untuk detail pengajuan tidak ditemukan. Pastikan route "pemeliharaan.detail_perbaikan" sudah terdaftar.');
            return;
        }

        modalBody.innerHTML = '<div style="text-align: center; padding: 50px;">Memuat data...</div>';
        modal.style.display = 'block';

        const detailUrl = baseUrl.replace('TEMP_ID', id);

        fetch(detailUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                modalBody.innerHTML = html;
            })
            .catch(error => {
                console.error('Gagal memuat detail pengajuan:', error);
                modalBody.innerHTML = '<div style="text-align: center; padding: 50px; color: red;">Gagal memuat detail. Cek route atau controller Anda.</div>';
            });
    }

    // Menutup modal saat mengklik di luar area modal
    window.onclick = function(event) {
        const modal = document.getElementById('detailPengajuanModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    
    function tutupModal() {
        document.getElementById('detailPengajuanModal').style.display = 'none';
    }

</script>
@endsection
