@extends('layouts.main')

@section('content')

<div>
    <style>
        .page-header {
            padding: 0 0 10px 0;
            color: #333;
            font-size: 1.2em;
            font-weight: 500;
        }

        .page-subheader-card {
            background-color: #0b4f8c;
            color: white;
            padding: 15px;
            border-bottom: none;
            margin-bottom: 0 !important;
        }

        .page-subheader-card h2 {
            margin: 0;
            font-size: 1.8em;
            font-weight: 600;
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            /* Set margin-top ke 0 untuk menghilangkan jarak berlebih dari atas (navbar/header Selamat Datang Admin) */
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* CSS Lainnya Dibiarkan Sama Sesuai Contoh Anda */
        .card-header {
            background-color: #ffffff;
            color: #333;
            padding: 18px 20px;
            border-bottom: 1px solid #ddd;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.6em;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
            overflow-x: auto;
        }

        #tabelPengajuanPerbaikan {
            width: 100%;
            min-width: 900px;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 5px;
        }

        #tabelPengajuanPerbaikan th,
        #tabelPengajuanPerbaikan td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
            font-size: 0.9em;
        }

        #tabelPengajuanPerbaikan th:first-child,
        #tabelPengajuanPerbaikan td:first-child {
            border-left: 1px solid #eee;
        }

        #tabelPengajuanPerbaikan thead th {
            background-color: #f0f4f7;
            color: #333;
            font-weight: 700;
        }

        #tabelPengajuanPerbaikan tbody tr:hover {
            background-color: #f9f9f9;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75em;
            font-weight: bold;
            color: white;
            display: inline-block;
            text-transform: uppercase;
        }

        /* Sesuaikan status class jika diperlukan (Saya menggunakan status umum) */
        .status-disetujui {
            background-color: #28a745;
        }

        .status-ditolak {
            background-color: #dc3545;
        }

        .status-diproses {
            background-color: #007bff;
        }

        .status-menunggu {
            background-color: #ffc107;
            color: #333;
        }

        .status-selesai {
            background-color: #6c757d;
        }

        .btn-detail {
            background-color: #209439;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85em;
            transition: background-color 0.3s;
        }

        .btn-detail:hover {
            background-color: #1a7a2e;
        }

        .btn-detail:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 5% auto;
            padding: 0;
            width: 90%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 5%;
                opacity: 1
            }
        }

        .modal-header {
            background-color: #0b4f8c;
            color: white;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h5 {
            margin: 0;
            font-size: 1.2em;
        }

        .close-button {
            color: white;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close-button:hover {
            color: #ddd;
        }

        .modal-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .modal-body {
                flex-direction: row;
            }
        }

        .detail-info {
            flex: 2;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            font-size: 0.9em;
        }

        .detail-info p {
            margin-bottom: 8px;
        }

        .detail-info strong {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            color: #333;
        }

        .detail-actions {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .action-btn {
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 0.9em;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-setujui {
            background-color: #28a745;
        }

        .btn-tolak {
            background-color: #dc3545;
        }

        .btn-pimpinan {
            background-color: #007bff;
        }

        .btn-kembali {
            background-color: #343a40;
        }

        .action-btn:hover {
            filter: brightness(1.1);
        }
    </style>

    {{-- KONTEN UTAMA --}}
    <div class="card"
        id="mainPengajuanCard" {{-- ID diubah ke Pengajuan --}}
        data-detail-url="{{ route('pemeliharaan.detail_perbaikan', ['id' => 'TEMP_ID']) }}"> {{-- ROUTE diubah ke pengajuan perbaikan --}}

        {{-- HEADER BIRU (Menggunakan page-subheader-card) --}}
        <div class="page-subheader-card">
            <h4 class="mb-0">Pengajuan Perbaikan Aset</h4> {{-- JUDUL diubah ke Pengajuan Perbaikan --}}
        </div>

        {{-- CARD BODY (Tabel Data) --}}
        <div class="card-body">
            <table id="tabelPengajuanPerbaikan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Jenis Kerusakan</th>
                        <th>Keterangan Tambahan</th>
                        <th>Foto Kerusakan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Diajukan Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($pengajuan as $data)
                    @php
                    $status = $data->status ?? 'Dipending';
                    $statusClass = 'status-' . strtolower(str_replace(' ', '', $status));
                    $tglPengajuan = $data->tgl_pengajuan ? \Carbon\Carbon::parse($data->tgl_pengajuan)->format('d/m/Y') : '-';
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->kode_barang ?? '-' }}</td>
                        <td>{{ $data->nama_barang ?? '-' }}</td>
                        <td>{{ $data->jenis_barang ?? '-' }}</td>
                        <td>{{ $data->jenis_kerusakan ?? '-' }}</td>
                        <td>{{ $data->keterangan_tambahan ?? '-' }}</td>
                        <td>
                            @if ($data->foto_kerusakan_path)
                            <a href="{{ asset('storage/' . $data->foto_kerusakan_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $data->foto_kerusakan_path) }}" alt="Foto" width="70" style="border-radius:5px;">
                            </a>
                            @else
                            <span>Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ $tglPengajuan }}</td>
                        <td><span class="badge {{ $statusClass }}">{{ $status }}</span></td>
                        <td>{{ $data->user->name ?? 'Pegawai Tidak Ditemukan' }}</td>
                        <td>
                            <button
                                class="btn-detail"
                                data-id="{{ $data->id }}"
                                onclick="tampilkanDetailPengajuan(this)">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" style="text-align:center; padding:20px; color:#6c757d;">
                            Tidak ada pengajuan perbaikan yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailPengajuanModal" class="modal"> {{-- ID modal diubah ke Pengajuan --}}
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Pengajuan Perbaikan</h5>
            <span class="close-button" onclick="tutupModalPengajuan()">&times;</span> {{-- Fungsi tutup diubah --}}
        </div>
        <div class="modal-body" id="modal-body-content-pengajuan"> {{-- ID body modal diubah --}}
            <div style="text-align:center;">
                <p>Memuat detail pengajuan...</p>
            </div>
        </div>
    </div>
</div>

<script>
    const mainCardPengajuan = document.getElementById('mainPengajuanCard');

    if (!mainCardPengajuan) {
        console.error("Kesalahan JavaScript: Elemen 'mainPengajuanCard' tidak ditemukan.");
    }

    const baseUrlPengajuan = mainCardPengajuan ? mainCardPengajuan.getAttribute('data-detail-url') : null;

    function tampilkanDetailPengajuan(element) {
        const id = element.getAttribute('data-id');
        const modalBody = document.getElementById('modal-body-content-pengajuan');
        const detailModal = document.getElementById('detailPengajuanModal');

        if (!baseUrlPengajuan) {
            console.error("Kesalahan: Base URL route tidak ditemukan. Pastikan 'pemeliharaan.detail_perbaikan' terdaftar di web.php.");
            modalBody.innerHTML = `<p style="color:red; text-align:center; padding: 20px;">
                                    Kesalahan Konfigurasi Route. Cek Console Log.
                                  </p>`;
            detailModal.style.display = 'block';
            return;
        }

        // Tampilkan loading dan Modal
        modalBody.innerHTML = '<div style="text-align:center; padding: 50px;"><p style="margin-top: 10px;">Memuat data...</p></div>';
        detailModal.style.display = 'block';

        const detailUrl = baseUrlPengajuan.replace('TEMP_ID', id);

        fetch(detailUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Gagal mengambil data detail. Status: ${response.status}.`);
                }
                return response.text();
            })
            .then(html => {
                modalBody.innerHTML = html;
            })
            .catch(error => {
                console.error('Error AJAX:', error.message);
                modalBody.innerHTML = `<p style="color:red; text-align:center; padding: 20px;">
                                        ${error.message} <br> Kesalahan terjadi di sisi server.
                                      </p>`;
            });
    }

    function tutupModalPengajuan() {
        document.getElementById('detailPengajuanModal').style.display = 'none';
    }

    // Mengganti listener window.onclick agar hanya menutup modal pengajuan ini
    window.onclick = function(event) {
        const modal = document.getElementById('detailPengajuanModal');
        if (event.target == modal) {
            tutupModalPengajuan();
        }
    }
</script>
@endsection