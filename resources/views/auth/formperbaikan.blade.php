@extends('layouts.pegawai')

@section('title', 'Form Perbaikan')

@section('page-title', 'FORM PERBAIKAN')

@section('content')
    <div class="form-card">
        <div class="form-header">FORM PERBAIKAN</div>
        <form action="{{ route('form.perbaikan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="tanggalPengajuan">Tanggal Pengajuan</label>
                    <input type="date" id="tanggalPengajuan" name="tanggalPengajuan">
                </div>
                <div class="form-group">
                    <label for="jenisKerusakan">Jenis Kerusakan</label>
                    <input type="text" id="jenisKerusakan" name="jenisKerusakan">
                </div>
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" id="namaBarang" name="namaBarang">
                </div>
                <div class="form-group">
                    <label for="keteranganTambahan">Keterangan Tambahan</label>
                    <textarea id="keteranganTambahan" name="keteranganTambahan" rows="1"></textarea>
                </div>
                <div class="form-group">
                    <label for="kodeBarang">Kode Barang</label>
                    <input type="text" id="kodeBarang" name="kodeBarang">
                </div>
                <div class="form-group">
                    <label for="fotoKerusakan">Upload Foto Kerusakan</label>
                    <input type="file" id="fotoKerusakan" name="fotoKerusakan" style="padding: 5px; border: none;">
                </div>
                <div class="form-group">
                    <label for="jenisBarang">Jenis Barang</label>
                    <input type="text" id="jenisBarang" name="jenisBarang">
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
