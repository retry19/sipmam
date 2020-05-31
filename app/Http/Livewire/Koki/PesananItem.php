<?php

namespace App\Http\Livewire\Koki;

use App\Pesanan;
use Livewire\Component;

class PesananItem extends Component
{
    public $pesananId;

    public function mount($pesananId)
    {
        $this->pesananId = $pesananId;
    }

    public function render()
    {
        $pesanan = Pesanan::find($this->pesananId)[0];

        return view('livewire.koki.pesanan-item', [
            'pesanan' => $pesanan
        ]);
    }
}
