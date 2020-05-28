<?php

namespace App\Http\Controllers;

use App\DetailPesanan;
use App\Menu;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function detailPesanan($id, Request $request)
    {
        $listPesanan = DetailPesanan::where('pesanan_id', $id)->get();

        $list = [];

        foreach ($listPesanan as $pesanan) {
            $menu = Menu::find($pesanan->menu_id, ['nama_menu', 'harga']);
            
            $arrPesanan = [
                'id' => $pesanan->id,
                'pesanan_id' => $pesanan->pesanan_id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'jml_pesan' => $pesanan->jml_pesan,
            ];

            array_push($list, $arrPesanan);
        }

        return response()->json($list);
    }
}
