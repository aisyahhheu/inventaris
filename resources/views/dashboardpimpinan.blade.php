@extends('layouts.pimpinan')

@section('title', 'Dashboard')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for colors from the original image */
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

        /* Custom styles for general layout */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">


        <div class="flex-1 flex flex-col overflow-hidden">


            <main class="flex-1 overflow-y-auto p-6 space-y-6">
                <div class="grid grid-cols-4 gap-6">
                    <div class="bg-card-blue p-4 rounded-[10px] card-shadow h-[131px] w-[207px]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-[18px] font-bold text-[#FFFFFF]">Jumlah Aset</h3>
                                <p class="text-[24px] font-bold text-[#FFFFFF]"></p>

                            </div>
                            <div class="h-[46px] w-[53px] bg-subtle-blue rounded-[10px]"></div>
                        </div>
                        <div class="flex justify-center mt-3">
                            <a href="#" class="h-[28px] w-[192px] bg-subtle-blue rounded-[10px] text-[#FFFFFF] flex items-center justify-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <div class="bg-card-red p-4 rounded-[10px] card-shadow h-[131px] w-[207px]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-[18px] font-bold text-[#FFFFFF]">Peminjaman</h3>
                                <p class="text-[24px] font-bold text-[#FFFFFF]">60</p>
                            </div>
                            <div class="h-[46px] w-[53px] bg-subtle-red rounded-[10px]"></div>
                        </div>
                        <div class="flex justify-center mt-3">
                            <a href="#" class="h-[28px] w-[192px] bg-subtle-red rounded-[10px] text-[#FFFFFF] flex items-center justify-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <div class="bg-card-blue p-4 rounded-[10px] card-shadow h-[131px] w-[207px]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-[18px] font-bold text-[#FFFFFF]">Maintenance</h3>
                                <p class="text-[24px] font-bold text-[#FFFFFF]">100</p>
                            </div>
                            <div class="h-[46px] w-[53px] bg-subtle-blue rounded-[10px]"></div>
                        </div>
                        <div class="flex justify-center mt-3">
                            <a href="#" class="h-[28px] w-[192px] bg-subtle-blue rounded-[10px] text-[#FFFFFF] flex items-center justify-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    <div class="bg-card-green p-4 rounded-[10px] card-shadow h-[131px] w-[245px]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-[18px] font-bold text-[#FFFFFF]">Pengajuan Baru</h3>
                                <p class="text-[24px] font-bold text-[#FFFFFF]">36</p>
                            </div>
                            <div class="h-[46px] w-[53px] bg-subtle-green rounded-[10px]"></div>
                        </div>
                        <div class="flex justify-center mt-3">
                            <a href="#" class="h-[28px] w-[192px] bg-subtle-green rounded-[10px] text-[#FFFFFF] flex items-center justify-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-2 bg-[#AFC6D8] p-6 rounded-[10px] card-shadow">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold ">Informasi Aset</h2>
                            <div class="relative">
                                <input type="text" placeholder="CARI" class="border rounded-full px-4 py-1 text-sm pl-8">
                                <svg class="w-4 h-4 text-gray-500 absolute left-2 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 overflow-hidden">
                            <button class="text-3xl text-gray-400 hover:text-gray-600">&lt;</button>
                            <div class="flex-1 grid grid-cols-3 gap-4">
                                <div class="bg-[#722929] border  p-4 text-center">
                                    <h3 class="font-bold text-white">Nama Barang</h3>
                                    <div class="h-24 bg-white  my-2"></div>
                                    <div class="text-sm text-left text-white">
                                        <p>Tersedia: <span class="font-semibold"></span></p>
                                        <p>Masuk: <span class="font-semibold"></span></p>
                                        <p>Keluar: <span class="font-semibold"></span></p>
                                    </div>
                                </div>
                                <div class="bg-[#324A5F] text-white border p-4 text-center">
                                    <h3 class="font-bold">Nama Barang</h3>
                                    <div class="h-24 bg-white   my-2"></div>
                                    <div class="text-sm text-left">
                                        <p>Tersedia: <span class="font-semibold"></span></p>
                                        <p>Masuk: <span class="font-semibold"></span></p>
                                        <p>Keluar: <span class="font-semibold"></span></p>
                                    </div>
                                </div>
                                <div class="bg-[#444445] border  p-4 text-center">
                                    <h3 class="font-bold text-white">Nama Barang</h3>
                                    <div class="h-24 bg-white   my-2"></div>
                                    <div class="text-sm text-left text-white">
                                        <p>Tersedia: <span class="font-semibold"></span></p>
                                        <p>Masuk: <span class="font-semibold"></span></p>
                                        <p>Keluar: <span class="font-semibold"></span></p>
                                    </div>
                                </div>
                            </div>
                            <button class="text-3xl text-gray-400 hover:text-gray-600">&gt;</button>
                        </div>
                    </div>

                    <div class="col-span-1 bg-white p-6 rounded-lg card-shadow flex flex-col">
                        <h2 class="text-lg font-semibold mb-4">GRAFIK PENGAJUAN</h2>
                        <div class="flex-1 flex items-end">
                            <canvas id="chart"></canvas>
                        </div>
                        <div class="text-center mt-2">
                            <button class="text-blue-600 text-sm">Lihat selengkapnya</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg card-shadow">
                    <h2 class="text-lg font-semibold mb-4 text-center bg-[#709CC0]">Aktivitas Terbaru</h2>
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6">Tanggal</th>
                                <th class="py-3 px-6">Tipe</th>
                                <th class="py-3 px-6">Kode Barang</th>
                                <th class="py-3 px-6">Nama Barang</th>
                                <th class="py-3 px-6">Jumlah</th>
                                <th class="py-3 px-6">Gudang</th>
                            </tr>
                        </thead>
                        <p class="text-[24px] font-bold text-[#FFFFFF]"></p>



                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                datasets: [{
                        label: 'Peminjaman',
                        data: [8, 5, 9, 6, 4, 7],
                        backgroundColor: '#722929',
                        borderWidth: 0
                    },
                    {
                        label: 'Perbaikan',
                        data: [4, 2, 5, 3, 1, 2],
                        backgroundColor: '#2b5c87',
                        borderWidth: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            display: true
                        },
                        ticks: {
                            display: true
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide the legend as per the image
                    }
                }
            }
        });
    </script>
    <p>Total Aset: </p>

</body>

</html>
@endsection