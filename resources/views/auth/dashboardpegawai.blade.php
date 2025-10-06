@extends('layouts.pegawai')

@section('title', 'Dashboard Pegawai')

@section('page-title', 'DASHBOARD PEGAWAI')

@section('content')
    <div class="header">
        <div class="header-left">
            <span class="header-title">HOME</span>
        </div>
    </div>

    <div class="card-container">
        <div class="card blue-card">
            <h3>Perbaikan</h3>
            <a href="{{ route('form.perbaikan') }}" class="btn-ajukan">Ajukan</a>
            <i class="icon fas fa-cogs"></i>
        </div>
        <div class="card orange-card">
            <h3>Pembelian Sparepart</h3>
            <a href="{{ route('form.pembelian.sparepart') }}" class="btn-ajukan">Ajukan</a>
            <i class="icon fas fa-wrench"></i>
        </div>
        <div class="card green-card">
            <h3>Peminjaman</h3>
            <a href="{{ route('form.peminjaman') }}" class="btn-ajukan">Ajukan</a>
            <i class="icon fas fa-box-open"></i>
        </div>
        <div class="card purple-card">
            <h3>Laporan Saya</h3>
            <a href="{{ route('halaman.laporan') }}" class="btn-ajukan">Lihat Detail</a>
            <i class="icon fas fa-user"></i>
        </div>
    </div>

    <h2 class="section-title"><i class="fas fa-chart-bar"></i> Statistik Saya</h2>
    <div class="statistic-container">
        <div class="stat-card">
            <div class="stat-number">{{ $countPerbaikan }}</div>
            <div class="stat-text">Pengajuan Perbaikan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $countPembelian }}</div>
            <div class="stat-text">Pembelian Sparepart</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $countPeminjaman }}</div>
            <div class="stat-text">Peminjaman Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalLaporan }}</div>
            <div class="stat-text">Total Laporan</div>
        </div>
    </div>
@endsection
