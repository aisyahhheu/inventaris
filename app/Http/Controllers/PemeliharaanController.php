<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPerbaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PemeliharaanController extends Controller
{

    public function showPengajuanPerbaikan()
    {
        try {
            $dataPengajuan = PengajuanPerbaikan::orderBy('id', 'desc')->get();

        } catch (\Exception $e) {
            $dataPengajuan = [];
            Log::error("Gagal mengambil data Pengajuan Perbaikan: " . $e->getMessage());
        }


        return view('pengajuan-perbaikan', [
            'pengajuan' => $dataPengajuan,
        ]);
    }

    public function showDetailPerbaikan(Request $request, $id)
    {

        $detail = PengajuanPerbaikan::find($id);

        if (!$detail) {
            return response()->json(['error' => 'Data pengajuan tidak ditemukan.'], 404);
        }

        return view('pemeliharaan.modal_detail_perbaikan', ['data' => $detail]);
    }

    public function showPembelianSparepart()
    {

        $dataPembelian = []; 

        return view('pembelian-sparepart', [
            'pembelian' => $dataPembelian,
        ]);
    }
}
