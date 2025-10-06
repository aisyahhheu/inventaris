@extends('layouts.pegawai')

@section('title', 'Halaman Laporan')

@section('page-title', 'LAPORAN SAYA')

@section('content')
    <div class="tab-container">
        <div class="tabs">
            <div class="tab active" data-tab="perbaikan">Perbaikan</div>
            <div class="tab" data-tab="pembelian">Pembelian Sparepart</div>
            <div class="tab" data-tab="peminjaman">Peminjaman</div>
        </div>
        <div class="tab-content" id="perbaikan" style="display: block;">
                <div class="table-responsive">
                    <table id="table-perbaikan">
                        <thead>
                        <tr>
                            <th class="date-col">Tanggal Pengajuan</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jenis Kerusakan</th>
                            <th>Keterangan Tambahan</th>
                            <th class="status-col">Status</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach ($dataPerbaikan as $item)
                    <tr>
                        <td class="date-col">{{ date('d/m/Y', strtotime($item->tanggal_pengajuan)) }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->jenis_barang }}</td>
                        <td>{{ $item->jenis_kerusakan }}</td>
                        <td>{{ $item->keterangan_tambahan }}</td>
                        <td class="status-col status-{{ strtolower($item->status) }}">{{ $item->status }}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <div class="tab-content" id="pembelian" style="display: none;">
                <div class="table-responsive">
                    <table id="table-pembelian">
                        <thead>
                        <tr>
                            <th class="date-col">Tanggal Pengajuan</th>
                            <th>Nama Sparepart</th>
                            <th>Kode Barang Terkait</th>
                            <th class="jumlah-col">Jumlah</th>
                            <th>Alasan Pengajuan</th>
                            <th class="status-col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPembelian as $item)
                        <tr>
                            <td class="date-col">{{ date('d/m/Y', strtotime($item->tanggal_pengajuan)) }}</td>
                            <td>{{ $item->nama_sparepart }}</td>
                            <td>{{ $item->kode_barang_terkait }}</td>
                            <td class="jumlah-col">{{ $item->jumlah }}</td>
                            <td>{{ $item->alasan_pengajuan }}</td>
                            <td class="status-col status-{{ strtolower($item->status) }}">{{ $item->status }}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-content" id="peminjaman" style="display: none;">
                <div class="table-responsive">
                    <table id="table-peminjaman">
                        <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tim Kerja</th>
                            <th>Tujuan Peminjaman</th>
                            <th>Barang Dipinjam</th>
                            <th class="jumlah-col">Jumlah</th>
                            <th class="date-col">Tanggal Pinjam</th>
                            <th class="date-col">Tanggal Kembali</th>
                            <th class="status-col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPeminjaman as $item)
                        <tr>
                            <td>{{ $item->nama_pegawai }}</td>
                            <td>{{ $item->tim_kerja }}</td>
                            <td>{{ $item->tujuan_peminjaman }}</td>
                            <td>{{ $item->barang_yang_ingin_dipinjam }}</td>
                            <td class="jumlah-col">{{ $item->jumlah }}</td>
                            <td class="date-col">{{ date('d/m/Y', strtotime($item->tanggal_pinjam)) }}</td>
                            <td class="date-col">{{ date('d/m/Y', strtotime($item->tanggal_kembali)) }}</td>
                            <td class="status-col status-{{ strtolower($item->status) }}">{{ $item->status }}</td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                const target = tab.getAttribute('data-tab');
                tabContents.forEach(tc => {
                    if (tc.id === target) {
                        tc.style.display = 'block';
                    } else {
                        tc.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
