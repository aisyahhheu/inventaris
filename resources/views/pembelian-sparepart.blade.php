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

        /* Card Style */
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            /* Margin atas 0 untuk mendekatkan ke navbar/header */
            margin-top: 0; 
            margin-bottom: 20px;
        }

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

        /* Styling Tabel Pembelian Sparepart */
        #tabelPembelianSparepart { 
            width: 100%;
            min-width: 900px; /* Menyamakan lebar tabel */
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 5px;
        }

        #tabelPembelianSparepart th,
        #tabelPembelianSparepart td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
            font-size: 0.9em;
        }

        #tabelPembelianSparepart th:first-child,
        #tabelPembelianSparepart td:first-child {
            border-left: 1px solid #eee;
        }

        #tabelPembelianSparepart thead th {
            background-color: #f0f4f7;
            color: #333;
            font-weight: 700;
        }

        #tabelPembelianSparepart tbody tr:hover {
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

        .status-disetujui { background-color: #28a745; }
        .status-ditolak { background-color: #dc3545; }
        .status-diproses { background-color: #007bff; }
        .status-menunggu { background-color: #ffc107; color: #333; }
        .status-selesai { background-color: #6c757d; }

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
            from { top: -300px; opacity: 0 }
            to { top: 5%; opacity: 1 }
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

        .btn-setujui { background-color: #28a745; }
        .btn-tolak { background-color: #dc3545; }
        .btn-pimpinan { background-color: #007bff; }
        .btn-kembali { background-color: #343a40; }

        .action-btn:hover {
            filter: brightness(1.1);
        }
    </style>

    {{-- KONTEN UTAMA --}}
    <div class="card"
        id="mainPembelianCard" 
        data-detail-url="{{ route('pembelian.detail_sparepart', ['id' => 'TEMP_ID']) }}">

        {{-- HEADER BIRU (Menggunakan page-subheader-card) --}}
        <div class="page-subheader-card">
            <h4 class="mb-0">Pembelian Sparepart</h4> 
        </div>

        {{-- CARD BODY (Tabel Data) --}}
        <div class="card-body">
            <table id="tabelPembelianSparepart">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Diajukan Oleh</th>
                        <th>Tanggal Pembelian</th>
                        <th>Jenis Kerusakan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($pembelian as $data) 
                    @php
                    $status = $data->status ?? 'Menunggu';
                    $statusClass = 'status-' . strtolower(str_replace(' ', '', $status)); 
                    $tglPembelian = $data->tgl_pembelian ? \Carbon\Carbon::parse($data->tgl_pembelian)->format('d/m/Y') : '-'; 
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->kode_aset ?? '-' }}</td>
                        <td>{{ $data->nama_aset ?? '-' }}</td>
                        <td>{{ $data->nama_pegawai ?? '-' }}</td>
                        <td>{{ $tglPembelian }}</td> 
                        <td>{{ $data->jenis_kerusakan ?? '-' }}</td>
                        <td><span class="badge {{ $statusClass }}">{{ $status }}</span></td>
                        <td>
                            @if(isset($data->id))
                            <button
                                class="btn-detail"
                                data-id="{{ $data->id }}"
                                onclick="tampilkanDetailPembelian(this)"> 
                                Lihat Detail
                            </button>
                            @else
                            <button class="btn-detail" disabled>Error ID</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px; color: #6c757d;">
                            Tidak ada data pembelian sparepart yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="detailPembelianModal" class="modal"> 
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Pembelian Sparepart</h5> 
            <span class="close-button" onclick="tutupModalPembelian()">&times;</span> 
        </div>
        <div class="modal-body" id="modal-body-content-pembelian"> 
            <div style="text-align:center;">
                <p>Memuat detail pembelian...</p>
            </div>
        </div>
    </div>
</div>

<script>
    const mainCardPembelian = document.getElementById('mainPembelianCard'); 

    if (!mainCardPembelian) {
        console.error("Kesalahan JavaScript: Elemen 'mainPembelianCard' tidak ditemukan.");
    }

    const baseUrlPembelian = mainCardPembelian ? mainCardPembelian.getAttribute('data-detail-url') : null; 

    function tampilkanDetailPembelian(element) { 
        const id = element.getAttribute('data-id');
        const modalBody = document.getElementById('modal-body-content-pembelian'); 
        const detailModal = document.getElementById('detailPembelianModal'); 

        if (!baseUrlPembelian) { 
            console.error("Kesalahan: Base URL route tidak ditemukan. Pastikan 'pembelian.detail_sparepart' terdaftar di web.php.");
            modalBody.innerHTML = `<p style="color:red; text-align:center; padding: 20px;">
                                    Kesalahan Konfigurasi Route. Cek Console Log.
                                  </p>`;
            detailModal.style.display = 'block';
            return;
        }

        // Tampilkan loading dan Modal
        modalBody.innerHTML = '<div style="text-align:center; padding: 50px;"><p style="margin-top: 10px;">Memuat data...</p></div>';
        detailModal.style.display = 'block';

        const detailUrl = baseUrlPembelian.replace('TEMP_ID', id); 

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

    function tutupModalPembelian() { 
        document.getElementById('detailPembelianModal').style.display = 'none'; 
    }

    // Mengganti listener window.onclick agar hanya menutup modal pembelian ini
    window.onclick = function(event) {
        const modal = document.getElementById('detailPembelianModal'); 
        if (event.target == modal) {
            tutupModalPembelian(); 
        }
    }
</script>
@endsection