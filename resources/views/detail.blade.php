<div class="detail-container">
    <table class="table-detail">
        <tr>
            <td><strong>Kode Barang</strong></td>
            <td>: {{ $peminjaman->kode_barang }}</td>
        </tr>
        <tr>
            <td><strong>Nama Barang</strong></td>
            <td>: {{ $peminjaman->nama_barang }}</td>
        </tr>
        <tr>
            <td><strong>Nama Pegawai</strong></td>
            <td>: {{ $peminjaman->nama_pegawai }}</td>
        </tr>
        <tr>
            <td><strong>Unit/Divisi</strong></td>
            <td>: {{ $peminjaman->unit_divisi }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah</strong></td>
            <td>: {{ $peminjaman->jumlah }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Pinjam</strong></td>
            <td>: {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Kembali</strong></td>
            <td>: {{ $peminjaman->tgl_kembali ? \Carbon\Carbon::parse($peminjaman->tgl_kembali)->format('d/m/Y') : '-' }}</td>
        </tr>
        <tr>
            <td><strong>Status</strong></td>
            <td>:
                <span class="status-badge 
                    @if($peminjaman->status == 'Disetujui') status-ijo
                    @elseif($peminjaman->status == 'Ditolak') status-merah
                    @elseif($peminjaman->status == 'Dipending') status-kuning
                    @else status-abu @endif">
                    {{ $peminjaman->status }}
                </span>
            </td>
        </tr>
    </table>

    <form id="updateStatusForm" action="{{ route('peminjaman.updateStatus', $peminjaman->id) }}" method="POST">
        @csrf
        <input type="hidden" name="status" id="statusInput">

        <div class="button-container">
            <div class="button-grid">
                <button type="button" class="btn btn-accept" onclick="ubahStatus('Disetujui')">Setujui</button>
                <button type="button" class="btn btn-decline" onclick="ubahStatus('Ditolak')">Tolak</button>
                <button type="button" class="btn btn-pending" onclick="ubahStatus('Dipending')">Ajukan ke Pimpinan</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-back">Kembali</a>
            </div>
        </div>
    </form>
</div>

<style>
.detail-container {
    padding: 15px 25px;
    font-family: Arial, sans-serif;
}

/* Table info */
.table-detail {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}
.table-detail td {
    padding: 8px 4px;
    font-size: 15px;
    vertical-align: top;
}

/* Status badge */
.status-badge {
    padding: 5px 12px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    font-size: 13px;
}
.status-ijo { background-color: #28a745; }
.status-merah { background-color: #dc3545; }
.status-kuning { background-color: #ffc107; color: #000; }
.status-abu { background-color: #6c757d; }

/* Tombol */
.button-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.button-grid {
    display: grid;
    grid-template-columns: repeat(2, 220px);
    grid-template-rows: repeat(2, auto);
    gap: 14px 30px;
    justify-content: center;
    margin-top: 10px;
}

.btn {
    padding: 10px 15px;
    border: none;
    color: white;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.2s;
    width: 100%;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.btn:hover {
    opacity: 0.9;
}

.btn-accept { background-color: #28a745; }
.btn-decline { background-color: #dc3545; }
.btn-pending { background-color: #0d6efd; }
.btn-back { background-color: #6c757d; text-decoration: none; display: inline-block; }
</style>

<script>
function ubahStatus(status) {
    if (!confirm(`Yakin ingin ubah status menjadi "${status}"?`)) return;

    const form = document.getElementById('updateStatusForm');
    const statusInput = document.getElementById('statusInput');
    statusInput.value = status;

    fetch(form.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: new FormData(form)
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || 'Status berhasil diperbarui.');
        window.location.href = "{{ route('peminjaman.index') }}";
    })
    .catch(() => alert('Terjadi kesalahan saat memperbarui status.'));
}
</script>
