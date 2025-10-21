<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DashboardController;
<<<<<<< HEAD
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DataAsetController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PemeliharaanController;
use App\Http\Controllers\LaporanController;

=======
use App\Http\Controllers\DashboardPegawaiController;
>>>>>>> manda

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


<<<<<<< HEAD
=======
//dashboard pegawai
Route::get('/dashboardpegawai', [DashboardController::class, 'index']);

// Dashboard (bisa dikasih middleware kalau mau)
>>>>>>> manda
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rute untuk Halaman Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

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

// ROUTE DETAIL LAPORAN
Route::get('/laporan/data-aset', [LaporanController::class, 'dataAset'])->name('laporan.data_aset');
Route::get('/laporan/barang-masuk', [LaporanController::class, 'barangMasuk'])->name('laporan.barang_masuk');
Route::get('/laporan/barang-keluar', [LaporanController::class, 'barangKeluar'])->name('laporan.barang_keluar');
Route::get('/laporan/pengajuan-perbaikan', [LaporanController::class, 'pengajuanPerbaikan'])->name('laporan.pengajuan_perbaikan');
Route::get('/laporan/pembelian-sparepart', [LaporanController::class, 'pembelianSparepart'])->name('laporan.pembelian_sparepart');
Route::get('/laporan/ringkasan', [LaporanController::class, 'ringkasan'])->name('laporan.ringkasan');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
