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
                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" required>
            </div>

            <div class="form-group">
                <label for="jenis_kerusakan">Jenis Kerusakan</label>
                <input type="text" id="jenis_kerusakan" name="jenis_kerusakan" placeholder="Contoh: Mati total, retak, patah" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" placeholder="Contoh: Printer Canon L3210" required>
            </div>

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" id="kode_barang" name="kode_barang" placeholder="Contoh: BRG-001" required>
            </div>

            <div class="form-group">
                <label for="jenis_barang">Jenis Barang</label>
                <input type="text" id="jenis_barang" name="jenis_barang" placeholder="Contoh: Elektronik, Furniture, dsb" required>
            </div>

            <div class="form-group">
                <label for="keterangan_tambahan">Keterangan Tambahan</label>
                <textarea id="keterangan_tambahan" name="keterangan_tambahan" rows="2" placeholder="Tuliskan keterangan tambahan (opsional)"></textarea>
            </div>

            <div class="form-group">
                <label for="foto_kerusakan">Upload Foto Kerusakan</label>
                <input type="file" id="foto_kerusakan" name="foto_kerusakan" accept="image/*" style="padding: 5px; border: none;">
            </div>

        </div>

        <div class="form-buttons">
            <button type="submit" class="btn btn-blue">Ajukan</button>
            <button type="reset" class="btn btn-grey">Reset</button>
            <a href="{{ url('/dashboard') }}" class="btn btn-red">Batal</a>
        </div>
    </form>
</div>
@endsection
