<div class="row p-3">
    <div class="col-md-7">
        <h6 class="text-primary mb-3">Informasi Peminjaman</h6>
        <table class="table table-sm table-striped">
            <tr><td style="width: 150px;">**Kode Barang**</td><td>: {{ $data->kode_barang }}</td></tr>
            <tr><td>**Nama Barang**</td><td>: {{ $data->nama_barang }}</td></tr>
            <tr><td>**Nama Pegawai**</td><td>: {{ $data->nama_pegawai }}</td></tr>
            <tr><td>**Unit/Divisi**</td><td>: {{ $data->unit_divisi }}</td></tr>
            <tr><td>**Jumlah**</td><td>: {{ $data->jumlah }}</td></tr>
            <tr><td>**Tanggal Pinjam**</td><td>: {{ \Carbon\Carbon::parse($data->tgl_pinjam)->format('d/m/Y') }}</td></tr>
            <tr><td>**Tanggal Kembali**</td><td>: {{ $data->tgl_kembali ? \Carbon\Carbon::parse($data->tgl_kembali)->format('d/m/Y') : '-' }}</td></tr>
            <tr><td>**Status**</td><td>: **{{ $data->status }}**</td></tr>
        </table>
    </div>
    
    <div class="col-md-5 d-flex flex-column justify-content-start gap-2">
        @if ($data->status == 'Dipending')
            <form action="{{ route('peminjaman.update_status', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Disetujui">
                <button type="submit" class="btn btn-success btn-block w-100">Setujui</button>
            </form>
            
            <form action="{{ route('peminjaman.update_status', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="Ditolak">
                <button type="submit" class="btn btn-danger btn-block w-100">Tolak</button>
            </form>

            <button class="btn btn-info btn-block w-100 text-white">Ajukan Ke Pimpinan</button>
        @else
            <p class="text-center mt-3 p-3 border rounded">Status telah **{{ $data->status }}**</p>
            @if ($data->status == 'Disetujui')
                <button class="btn btn-primary btn-block w-100">Proses Pengembalian</button>
            @endif
        @endif

        <button type="button" class="btn btn-dark btn-block w-100 mt-auto" data-bs-dismiss="modal">Kembali</button>
    </div>
</div>