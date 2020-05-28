<?php

namespace App\Http\Livewire\Pelayan;

use App\Pesanan;
use Livewire\Component;

class PesananIndex extends Component
{
    public $statusSelected = null;
    public $mejaSearch = null;
    public $i = 1;

    public function handleStatusSelected($status)
    {
        // 
    }

    public function status($status) {
        $result = '';
        switch ($status) {
            case 0:
                $result = 'Menunggu koki';
                break;
            case 1:
                $result = 'Sedang dimasak koki';
                break;
            case 2:
                $result = 'Telah dihidangkan';
                break;
            default:
                $result = 'Pesanan selesai';
                break;
        }

        return $result;
    }

    public function render()
    {
        $pesanan = Pesanan::latest()->paginate(10);
        
        return view('livewire.pelayan.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
