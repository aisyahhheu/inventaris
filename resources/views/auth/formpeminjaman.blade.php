@extends('layouts.pegawai')

@section('title', 'Form Peminjaman')

@section('page-title', 'FORM PEMINJAMAN')

@section('content')
    <div class="form-card">
        <div class="form-header">FORM PEMINJAMAN</div>
        <form action="{{ route('form.peminjaman.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="namaPegawai">Nama Pegawai</label>
                    <input type="text" id="namaPegawai" name="namaPegawai" required />
                </div>
                <div class="form-group">
                    <label for="timKerja">Tim Kerja</label>
                    <input type="text" id="timKerja" name="timKerja" required />
                </div>
                <div class="form-group">
                    <label for="tujuanPeminjaman">Tujuan Peminjaman</label>
                    <input type="text" id="tujuanPeminjaman" name="tujuanPeminjaman" required />
                </div>
                <div class="form-group">
                    <label for="barangDipinjam">Barang Yang Ingin Dipinjam</label>
                    <input type="text" id="barangDipinjam" name="barangDipinjam" required />
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" min="1" required />
                </div>
                <div class="form-group">
                    <label for="tanggalPinjam">Tanggal Pinjam</label>
                    <input type="date" id="tanggalPinjam" name="tanggalPinjam" required />
                </div>
                <div class="form-group">
                    <label for="tanggalKembali">Tanggal Kembali</label>
                    <input type="date" id="tanggalKembali" name="tanggalKembali" required />
                </div>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-blue">Ajukan</button>
                <button type="reset" class="btn btn-grey">Reset</button>
                        <a href="{{ route('dashboard.pegawai') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>
@endsection
