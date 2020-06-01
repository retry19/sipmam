<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use App\Pesanan;
use Livewire\Component;

class PesananMenuEmpty extends Component
{
    public $pesananId;
    public $kosong = [];
    public $no = 1;

    public function storeMenuKosong()
    {
        $menuIdKosong = array_keys(array_filter($this->kosong));
        
        foreach ($menuIdKosong as $menuId) {
            Menu::find($menuId)->update([
                'kosong' => 1
            ]);
        }

        return redirect()->route('koki.pesanan-all');
    }

    public function mount($id)
    {
        $this->pesananId = $id;
    }

    public function render()
    {
        $pesanan = Pesanan::find($this->pesananId);

        return view('livewire.koki.pesanan-menu-empty', [
            'pesanan' => $pesanan
        ]);
    }
}
