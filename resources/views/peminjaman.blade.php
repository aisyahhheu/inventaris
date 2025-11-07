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

        #tabelPeminjaman {
            width: 100%;
            min-width: 900px;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 5px;
        }

        #tabelPeminjaman th,
        #tabelPeminjaman td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
            font-size: 0.9em;
        }

        #tabelPeminjaman th:first-child,
        #tabelPeminjaman td:first-child {
            border-left: 1px solid #eee;
        }

        #tabelPeminjaman thead th {
            background-color: #f0f4f7;
            color: #333;
            font-weight: 700;
        }

        #tabelPeminjaman tbody tr:hover {
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

        .status-disetujui {
            background-color: #28a745;
        }

        .status-ditolak {
            background-color: #dc3545;
        }

        .status-dipending {
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

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>

    <div class="card" id="peminjamanCard" data-detail-url="{{ route('peminjaman.detail', ['id' => 'TEMP_ID']) }}">
        <div class="page-subheader-card">
            <h4 class="mb-0">Peminjaman Aset</h4>
        </div>

        <div class="card-body">
            <table id="tabelPeminjaman" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Nama Pegawai</th>
                        <th>Unit/Divisi</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse ($peminjaman as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->kode_barang ?? '-' }}</td>
                        <td>{{ $data->nama_barang ?? '-' }}</td>
                        <td>{{ $data->nama_pegawai ?? '-' }}</td>
                        <td>{{ $data->unit_divisi ?? '-' }}</td>
                        <td>{{ $data->jumlah ?? '0' }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td>{{ $data->tgl_kembali ? \Carbon\Carbon::parse($data->tgl_kembali)->format('d/m/Y') : '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($data->status == 'Disetujui') bg-success
                                @elseif($data->status == 'Ditolak') bg-danger
                                @elseif($data->status == 'Dipending') bg-warning
                                @else bg-secondary @endif">
                                {{ $data->status }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" data-id="{{ $data->id }}" onclick="tampilkanDetail(this)">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Tidak ada data peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div id="detailModal" class="modal" style="display:none;">
        <div class="modal-content" style="width: 600px; margin: 10% auto; background: #fff; border-radius: 10px; padding: 20px; position: relative;">
            <div class="modal-header" style="display:flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd;">
                <h5 class="modal-title">Detail Peminjaman</h5>
                <button class="close-button" onclick="tutupModal()" style="background:none; border:none; font-size: 20px;">&times;</button>
            </div>

            <div class="modal-body" id="modal-body-content" style="padding: 20px;">
                <div style="text-align:center;">
                    <p>Memuat detail peminjaman...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const baseUrl = document.getElementById('peminjamanCard').getAttribute('data-detail-url');

        function tampilkanDetail(element) {
            const id = element.getAttribute('data-id');
            const modalBody = document.getElementById('modal-body-content');
            const detailModal = document.getElementById('detailModal');

            modalBody.innerHTML = `<p class="text-center">Memuat detail peminjaman...</p>`;
            detailModal.style.display = 'block';

            fetch(baseUrl.replace('TEMP_ID', id))
                .then(res => {
                    if (!res.ok) throw new Error('Gagal mengambil data');
                    return res.text();
                })
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(err => {
                    console.error(err);
                    modalBody.innerHTML = `<p style="color:red; text-align:center;">Gagal memuat data peminjaman.</p>`;
                });
        }

        function tutupModal() {
            document.getElementById('detailModal').style.display = 'none';
        }

        window.onclick = function(e) {
            const modal = document.getElementById('detailModal');
            if (e.target == modal) tutupModal();
        }
    </script>
    @endsection