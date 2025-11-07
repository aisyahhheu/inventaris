@extends('layouts.pimpinan')

@section('title', 'Dashboard Pimpinan')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pimpinan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Tambahkan link ke file CSS --}}
  <link rel="stylesheet" href="{{ asset('css/dashboard-pimpinan.css') }}">
  <style>
    .bg-card-blue {
  background-color: #2c5d86;
}

.bg-card-red {
  background-color: #722929;
}

.bg-card-green {
  background-color: #669682;
}

.bg-subtle-blue {
  background-color: #5880a3;
}

.bg-subtle-red {
  background-color: #d58f8f;
}

.bg-subtle-green {
  background-color: #c7ded5;
}

/* Opsional: tambahan efek hover global */
a:hover {
  opacity: 0.9;
  transition: all 0.3s ease;
}

  </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
  <div class="min-h-screen p-8 space-y-8">

    {{-- === Kartu Statistik Utama === --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      {{-- Jumlah Aset --}}
      <div class="bg-card-blue p-5 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-white">Jumlah Aset</h3>
            <p class="text-3xl font-bold text-white mt-1">{{ $jumlah_aset }}</p>
          </div>
          <div class="h-12 w-12 bg-subtle-blue rounded-xl"></div>
        </div>
        <a href="#" class="mt-4 block text-center bg-subtle-blue text-white rounded-xl py-2 text-sm hover:opacity-90 transition">Lihat Detail</a>
      </div>

      {{-- Peminjaman --}}
      <div class="bg-card-red p-5 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-white">Peminjaman</h3>
            <p class="text-3xl font-bold text-white mt-1">60</p>
          </div>
          <div class="h-12 w-12 bg-subtle-red rounded-xl"></div>
        </div>
        <a href="{{ route('peminjamanpimpinan') }}" class="menu-link mt-4 block text-center bg-subtle-red text-white rounded-xl py-2 text-sm hover:opacity-90 transition">Lihat Detail</a>
      </div>

      {{-- Maintenance --}}
      <div class="bg-card-blue p-5 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-white">Maintenance</h3>
            <p class="text-3xl font-bold text-white mt-1">100</p>
          </div>
          <div class="h-12 w-12 bg-subtle-blue rounded-xl"></div>
        </div>
        <a href="{{ route('perbaikanpimpinan') }}" class="menu-link mt-4 block text-center bg-subtle-blue text-white rounded-xl py-2 text-sm hover:opacity-90 transition">Lihat Detail</a>
      </div>

      {{-- Pengajuan Baru --}}
      <div class="bg-card-green p-5 rounded-2xl shadow-md hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-white">Pengajuan Baru</h3>
            <p class="text-3xl font-bold text-white mt-1">36</p>
          </div>
          <div class="h-12 w-12 bg-subtle-green rounded-xl"></div>
        </div>
        <a href="#" class="mt-4 block text-center bg-subtle-green text-white rounded-xl py-2 text-sm hover:opacity-90 transition">Lihat Detail</a>
      </div>
    </div>

    {{-- === Informasi Aset & Grafik === --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      {{-- Informasi Aset --}}
      <div class="col-span-2 bg-[#AFC6D8] p-6 rounded-2xl shadow-md">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-lg font-semibold text-gray-800">Informasi Aset</h2>
          <div class="relative">
            <input type="text" placeholder="Cari aset..." class="border rounded-full px-4 py-1 text-sm pl-8 focus:ring focus:ring-blue-300 outline-none">
            <svg class="w-4 h-4 text-gray-500 absolute left-2 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>

        <div class="flex items-center space-x-4 overflow-hidden">
          <button class="text-3xl text-gray-500 hover:text-gray-700">&lt;</button>
          <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-[#722929] rounded-xl p-4 text-center text-white shadow">
              <h3 class="font-semibold mb-2">Nama Barang</h3>
              <div class="h-24 bg-white rounded mb-2"></div>
              <div class="text-sm text-left space-y-1">
                <p>Tersedia: <span class="font-semibold">-</span></p>
                <p>Masuk: <span class="font-semibold">-</span></p>
                <p>Keluar: <span class="font-semibold">-</span></p>
              </div>
            </div>

            <div class="bg-[#324A5F] rounded-xl p-4 text-center text-white shadow">
              <h3 class="font-semibold mb-2">Nama Barang</h3>
              <div class="h-24 bg-white rounded mb-2"></div>
              <div class="text-sm text-left space-y-1">
                <p>Tersedia: <span class="font-semibold">-</span></p>
                <p>Masuk: <span class="font-semibold">-</span></p>
                <p>Keluar: <span class="font-semibold">-</span></p>
              </div>
            </div>

            <div class="bg-[#444445] rounded-xl p-4 text-center text-white shadow">
              <h3 class="font-semibold mb-2">Nama Barang</h3>
              <div class="h-24 bg-white rounded mb-2"></div>
              <div class="text-sm text-left space-y-1">
                <p>Tersedia: <span class="font-semibold">-</span></p>
                <p>Masuk: <span class="font-semibold">-</span></p>
                <p>Keluar: <span class="font-semibold">-</span></p>
              </div>
            </div>
          </div>
          <button class="text-3xl text-gray-500 hover:text-gray-700">&gt;</button>
        </div>
      </div>

      {{-- Grafik Pengajuan --}}
      <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Pengajuan</h2>
        <div class="flex-1">
          <canvas id="chart"></canvas>
        </div>
        <button class="mt-3 text-blue-600 text-sm hover:underline">Lihat selengkapnya</button>
      </div>
    </div>

    {{-- === Aktivitas Terbaru === --}}
    <div class="bg-white p-6 rounded-2xl shadow-md">
      <h2 class="text-lg font-semibold mb-4 text-center bg-[#709CC0] text-white py-2 rounded-md">Aktivitas Terbaru</h2>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
              <th class="py-3 px-4 text-left">Tanggal</th>
              <th class="py-3 px-4 text-left">Tipe</th>
              <th class="py-3 px-4 text-left">Kode Barang</th>
              <th class="py-3 px-4 text-left">Nama Barang</th>
              <th class="py-3 px-4 text-left">Jumlah</th>
              <th class="py-3 px-4 text-left">Gudang</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @foreach($latest_aset as $data)
            <tr class="border-b hover:bg-gray-50 transition">
              <td class="py-3 px-4">{{ $data->tanggal }}</td>
              <td class="py-3 px-4">
                @if ($data->masuk > 0)
                  <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs">Masuk</span>
                @else
                  <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs">Keluar</span>
                @endif
              </td>
              <td class="py-3 px-4">BR-{{ $data->id }}</td>
              <td class="py-3 px-4">{{ $data->nama_barang }}</td>
              <td class="py-3 px-4">{{ $data->jumlah }}</td>
              <td class="py-3 px-4">{{ $data->gudang }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- === Chart JS === --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('chart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [
          { label: 'Peminjaman', data: [8, 5, 9, 6, 4, 7], backgroundColor: '#722929' },
          { label: 'Perbaikan', data: [4, 2, 5, 3, 1, 2], backgroundColor: '#2b5c87' }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false } },
          y: { grid: { color: '#e5e7eb' }, ticks: { stepSize: 2 } }
        }
      }
    });
  </script>
</body>
</html>
@endsection
