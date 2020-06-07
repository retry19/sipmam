<?php

namespace App\Http\Livewire\Kasir;

use App\Transaksi;
use Carbon\Carbon;
use Livewire\Component;

class TransaksiIndex extends Component
{
    public function render()
    {
        $transaksi = Transaksi::whereDate('created_at', Carbon::today())
                        ->orderBy('updated_at', 'desc')
                        ->paginate(10);

        return view('livewire.kasir.transaksi-index', [
            'transaksi' => $transaksi
        ]);
    }
}
