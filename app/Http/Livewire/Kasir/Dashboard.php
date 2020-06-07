<?php

namespace App\Http\Livewire\Kasir;

use App\Pesanan;
use App\Transaksi;
use Livewire\Component;

class Dashboard extends Component
{
    public $countPesanan;
    public $countTransaksi;

    public function mount()
    {
        $this->countPesanan = Pesanan::whereDate('created_at', now())->count();
        $this->countTransaksi = Transaksi::whereDate('created_at', now())
                                        ->where('status', 1)
                                        ->count();
    }

    public function render()
    {
        return view('livewire.kasir.dashboard');
    }
}
