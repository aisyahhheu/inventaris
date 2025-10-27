@extends('layouts.pegawai')

@section('title', 'Form Pembelian Sparepart')

@section('page-title', 'FORM PEMBELIAN SPAREPART')

@section('content')
<div class="form-card">
    <div class="form-header">FORM PEMBELIAN SPAREPART</div>
    <form action="{{ route('form.pembelian.sparepart.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="tanggalPengajuan">Tanggal Pengajuan</label>
                <input type="date" id="tanggalPengajuan" name="tanggalPengajuan" required>
            </div>
            <div class="form-group">
                <label for="namaSparepart">Nama Sparepart</label>
                <input type="text" id="namaSparepart" name="namaSparepart" required>
            </div>
            <div class="form-group">
                <label for="kodeBarangTerkait">Kode Barang Terkait</label>
                <input type="text" id="kodeBarangTerkait" name="kodeBarangTerkait" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" min="1" required>
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label for="alasanPengajuan">Alasan Pengajuan</label>
                <textarea id="alasanPengajuan" name="alasanPengajuan" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="fotoKerusakan">Upload Foto Kerusakan</label>
                <input type="file" id="fotoKerusakan" name="fotoKerusakan" accept="image/*" required style="padding: 5px; border: none;">
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
