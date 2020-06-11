<?php

namespace App\Http\Livewire;

use App\DetailPesanan;
use Livewire\Component;

class Home extends Component
{
    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function render()
    {
        $favoriteMenus = DetailPesanan::groupBy('menu_id')
                        ->selectRaw('menu_id,SUM(jml_pesan) AS jml_pesan')
                        ->orderBy('jml_pesan', 'desc')
                        ->take(6)
                        ->get();

        return view('livewire.home', ['favoriteMenus' => $favoriteMenus]);
    }
}
