<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\Transaksi;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function detailPesanan($id)
    {
        $listPesanan = Pesanan::find($id);

        $list = [];

        foreach ($listPesanan->detailPesanan as $pesanan) {
            $arrPesanan = [
                'id' => $pesanan->id,
                'pesanan_id' => $pesanan->pesanan_id,
                'nama_menu' => $pesanan->menu->nama_menu,
                'harga' => $pesanan->menu->harga,
                'jml_pesan' => $pesanan->jml_pesan,
            ];

            array_push($list, $arrPesanan);
        }

        return response()->json($list);
    }

    public function income()
    {
        $result = Transaksi::select(
                        DB::raw('SUM(total_bayar) AS total_bayar'),
                        DB::raw('SUM(kembali) AS kembali'),
                        DB::raw("DATE_FORMAT(created_at, '%M') as month"))
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->get();

        return response()->json($result);
    }

    public function pelanggan()
    {
        $result = Pesanan::select(
                        DB::raw('COUNT(*) AS pelanggan'),
                        DB::raw("DATE_FORMAT(created_at, '%M') as month"))
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->get();

        return response()->json($result);
    }
}
