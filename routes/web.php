<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DataAsetController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\laporanpimpinanController;

use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\FormPembelianSparepartController;
use App\Http\Controllers\FormPerbaikanController;
use App\Http\Controllers\FormPeminjamanController;
use App\Http\Controllers\HalamanLaporan;
use App\Http\Controllers\HalamanLaporanpimpinan;


use App\Http\Controllers\DashboardPimpinanController;
use App\Http\Controllers\PeminjamanPimpinanController;


// Halaman awal → redirect ke login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Forgot password
// Forgot password (Alur Lengkap)
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('password.email'); 

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Rute untuk Halaman Dashboard Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Rute untuk Halaman Dashboard Pegawai
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/dashboardpegawai', [DashboardPegawaiController::class, 'index'])->name('dashboardpegawai');
});

Route::get('/dashboardpegawai', [DashboardPegawaiController::class, 'index'])->name('dashboard.pegawai');

// Form routes for pegawai
Route::get('/form-perbaikan', [FormPerbaikanController::class, 'create'])->name('form.perbaikan.create');
Route::post('/form-perbaikan', [FormPerbaikanController::class, 'store'])->name('form.perbaikan.store');

Route::get('/form-pembelian-sparepart', [FormPembelianSparepartController::class, 'showForm'])->name('form.pembelian.sparepart');
Route::post('/form-pembelian-sparepart', [FormPembelianSparepartController::class, 'store'])->name('form.pembelian.sparepart.store');

Route::get('/form-peminjaman', [FormPeminjamanController::class, 'showForm'])->name('form.peminjaman');
Route::post('/form-peminjaman', [FormPeminjamanController::class, 'store'])->name('form.peminjaman.store');

Route::get('/halaman-laporan', [HalamanLaporan::class, 'index'])->name('halaman.laporan');
Route::get('/halaman-laporanpimpinan', [HalamanLaporanpimpinan::class, 'index'])->name('halaman.laporanpimpinan');

// rute dashboard pimpinan
Route::get('/dashboardpimpinan', [DashboardPimpinanController::class, 'index'])->name('dashboardpimpinan');


// Rute untuk Manajemen Inventaris
Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barangmasuk');
// Rute untuk menyimpan data form (POST)
Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');

// Rute untuk Export data (GET)
Route::get('/barang-masuk/export', [BarangMasukController::class, 'export'])->name('barang-masuk.export');

Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');
Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
Route::get('/barang-keluar/export', [BarangKeluarController::class, 'export'])->name('barang-keluar.export');
Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');

Route::get('/data-aset', [DataAsetController::class, 'index'])->name('dataaset');
Route::post('/data-aset', [DataAsetController::class, 'store'])->name('dataaset.store');
Route::get('/data-aset/export', [DataAsetController::class, 'export'])->name('data-aset.export');
Route::get('/data-aset', [DataAsetController::class, 'index'])->name('dataaset');

// Route untuk halaman utama tabel peminjaman
Route::get('/peminjaman-aset', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/detail/{id}', [PeminjamanController::class, 'showDetail'])
    ->name('peminjaman.detail');

// Route untuk update status peminjaman (Digunakan oleh form di detail modal)
Route::put('/peminjaman-aset/update-status/{id}', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.update_status');

Route::get('/pemeliharaan-aset', function () {
    return view('pemeliharaan_aset');
})->name('pemeliharaan_aset');

Route::get('/pengajuan-perbaikan', [PemeliharaanController::class, 'showPengajuanPerbaikan'])->name('pengajuanperbaikan');

// ROUTE UNTUK MODAL DETAIL (DIPANGGIL VIA AJAX)
// URL: /pemeliharaan/detail-perbaikan/{id}
// METHOD: showDetailPerbaikan
Route::get('/pemeliharaan/detail-perbaikan/{id}', [PemeliharaanController::class, 'showDetailPerbaikan'])->name('pemeliharaan.detail_perbaikan');

// ROUTE UNTUK HALAMAN PEMBELIAN SPAREPART
Route::get('/pembelian-sparepart', [PemeliharaanController::class, 'showPembelianSparepart'])->name('pembeliansparepart');

Route::get('/pembelian/detail-sparepart/{id}', [PemeliharaanController::class, 'detailSparepart'])
    ->name('pembelian.detail_sparepart');
Route::get('/laporanadmin', [LaporanController::class, 'index'])->name('laporanadmin');
Route::get('/laporanpimpinan', [laporanpimpinanController::class, 'index'])->name('laporanpimpinan');

// ROUTE DETAIL LAPORAN
Route::get('/laporan/data-aset', [LaporanController::class, 'dataAset'])->name('laporan.data_aset');
Route::get('/laporan/barang-masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.barang_masuk');
Route::get('/laporan/barang-keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.barang_keluar');
Route::get('/laporan/pengajuan-perbaikan', [LaporanController::class, 'pengajuanPerbaikan'])->name('laporan.pengajuan_perbaikan');
Route::get('/laporan/pembelian-sparepart', [LaporanController::class, 'pembelianSparepart'])->name('laporan.pembelian_sparepart');
Route::get('/laporan/ringkasan', [LaporanController::class, 'ringkasan'])->name('laporan.ringkasan');

// ROUTE DETAIL LAPORAN Pimpinan
Route::get('/laporanpimpinan/data-aset', [laporanpimpinanController::class, 'dataAset'])->name('laporanpimpinan.data_aset');
Route::get('/laporanpimpinan/barang-masuk', [laporanpimpinanController::class, 'barangMasuk'])->name('laporanpimpinan.barang_masuk');
Route::get('/laporanpimpinan/barang-keluar', [laporanpimpinanController::class, 'barangKeluar'])->name('laporanpimpinan.barang_keluar');
Route::get('/laporanpimpinan/pengajuan-perbaikan', [laporanpimpinanController::class, 'pengajuanPerbaikan'])->name('laporanpimpinan.pengajuan_perbaikan');
Route::get('/laporanpimpinan/pembelian-sparepart', [laporanpimpinanController::class, 'pembelianSparepart'])->name('laporanpimpinan.pembelian_sparepart');
Route::get('/laporanpimpinan/ringkasan', [laporanpimpinanController::class, 'ringkasan'])->name('laporanpimpinan.ringkasan');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/sparepartpimpinan', function () {
    return view('sparepartpimpinan');
})->name('sparepartpimpinan');

Route::get('/perbaikanpimpinan', function () {
    return view('perbaikanpimpinan');
})->name('perbaikanpimpinan');

Route::get('/peminjamanpimpinan', function () {
    return view('peminjamanpimpinan');
})->name('peminjamanpimpinan');
