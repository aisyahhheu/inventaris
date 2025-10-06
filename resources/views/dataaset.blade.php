@extends('layouts.main')

@section('title', 'Data Aset')

{{-- Menghapus @section('head') karena CSS dipindahkan --}}

@section('content')
<style>
    body {
        background-color: #e5e9f2;
        font-family: Arial, sans-serif;
    }

    .app-content-container {
        padding: 2px;
        margin-left: 2px;
        width: calc(100% - 2px);
        max-width: 100%;
        min-height: 100vh;
        box-sizing: border-box;
    }

    .card-custom {
        background-color: #fff;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        border: 1px solid #ddd;
        width: 100%;
    }

    .card-header-custom {
        padding: 15px 20px;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
        background-color: #f7f7f7;
        border-bottom: 1px solid #ddd;
    }

    .card-body-custom {
        padding: 25px 20px;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        width: 100%;
    }

    .form-col {
        flex-basis: calc(33.333% - 13.33px);
        max-width: calc(33.333% - 13.33px);
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: normal;
        color: #333;
        font-size: 0.9rem;
    }

    .form-control-custom {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        justify-content: center;

    }

    .btn-custom {
        padding: 8px 25px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.2s;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Tombol Simpan (Biru tua) */
    .btn-primary-custom {
        background-color: #2c3e50;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background-color: #1f2a36;
    }

    /* Tombol Reset (Abu-abu gelap) */
    .btn-secondary-custom {
        background-color: #7f8c8d;
        color: #fff;
    }

    .btn-secondary-custom:hover {
        background-color: #6c757d;
    }

    .btn-danger-custom {
        background-color: #a04000;
        color: #fff;
    }

    .btn-danger-custom:hover {
        background-color: #833300;
    }

    .btn-success-custom {
        background-color: #00ff00;
        color: #333;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .btn-success-custom:hover {
        background-color: #00e000;
    }

    .search-export-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .search-export-group {
        flex-grow: 1;
        margin-right: 15px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border: 1px solid #c0c0c0;
    }

    .table-custom th,
    .table-custom td {
        padding: 10px 12px;
        text-align: left;
        border: 1px solid #c0c0c0;
    }

    .table-custom thead th {
        background-color: #d1e2f7;
        color: #333;
        font-weight: 600;
        border-color: #c0c0c0;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #f7f7f7;
    }

    .table-custom tbody tr:nth-child(odd) {
        background-color: #fff;
    }

    .table-custom tbody tr:hover {
        background-color: #e9eff5;
    }

    @media (max-width: 992px) {
        .app-content-container {
            margin-left: 0;
            padding: 20px;
            width: 100%;
        }

        .form-col {
            flex-basis: 100%;
            max-width: 100%;
        }

        .search-export-row {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .search-export-group {
            margin-right: 0;
        }
    }
</style>
<div class="app-content-container">
    <div class="card-custom">
        <div class="card-header-custom">
            Form Data Aset
        </div>
        <div class="card-body-custom">
            <form action="{{ route('dataaset.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    {{-- Baris 1: Kode, Nama, Jenis --}}
                    <div class="form-col">
                        <div class="form-group">
                            <label for="kode_barang">Kode barang</label>
                            <input type="text" id="kode_barang" name="kode_barang" class="form-control-custom">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control-custom">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="jenis_barang">Jenis Barang</label>
                            <input type="text" id="jenis_barang" name="jenis_barang" class="form-control-custom">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    {{-- Baris 2: Jumlah, Satuan, Stok --}}
                    <div class="form-col">
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" class="form-control-custom">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-control-custom">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="stok_barang">Stok</label>
                            <input type="text" id="stok_barang" name="stok_barang" class="form-control-custom">
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-custom btn-primary-custom">Simpan</button>
                    <button type="reset" class="btn-custom btn-secondary-custom">Reset</button>
                    <a href="{{ route('dashboard') }}" class="btn-custom btn-danger-custom">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card-custom">
        <div class="card-body-custom">
            <div class="search-export-row">
                <div class="search-export-group">
                </div>
            </div>

            <form action="{{ route('dataaset') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" placeholder="Cari kode atau nama barang"
                    class="form-control" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('data-aset.export') }}" class="btn btn-success">Export</a>
            </form>

            <div class="table-responsive-custom">
                <table class="table-custom" id="itemTable">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>                   
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- PENTING: Pastikan variabel $barangs dikirim dari Controller --}}
                        @forelse ($dataaset as $barang)
                        <tr>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->jenis_barang }}</td>
                            <td>{{ $barang->jumlah }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->stok }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">Belum ada data aset.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('searchBar').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.getElementById('itemTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let found = false;

            if (cells.length > 1) {
                let kodeBarang = cells[0].textContent.toLowerCase();
                let namaBarang = cells[1].textContent.toLowerCase();

                if (kodeBarang.indexOf(filter) > -1 || namaBarang.indexOf(filter) > -1) {
                    found = true;
                }
            }
            rows[i].style.display = found ? "" : "none";
        }
    });
</script>
@endpush