<?php

namespace App\Http\Controllers;

use App\Pesanan;

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
}
