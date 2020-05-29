<?php

namespace App\Http\Livewire\Pelayan;

use App\DetailPesanan;
use App\Menu;
use GuzzleHttp\Client;
use Livewire\Component;

class PesananEdit extends Component
{
    public $i = 1;
    public $detailPesanan;

    private function getDetailPesanan($id) {
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

        return $list;
    }

    public function mount($id)
    {
        $this->detailPesanan = $this->getDetailPesanan($id);
    }

    public function render()
    {   
        return view('livewire.pelayan.pesanan-edit');
    }
}
