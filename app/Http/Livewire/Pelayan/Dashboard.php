<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use App\Pesanan;
use Livewire\Component;

class Dashboard extends Component
{
    public $countPesanan;
    public $countMenuReady;

    public function mount()
    {
        $this->countPesanan = Pesanan::whereDate('created_at', now())->count();
        $this->countMenuReady = Menu::where('jml_tersedia', '>', 'jml_dipesan')->count();
    }

    public function render()
    {
        return view('livewire.pelayan.dashboard');
    }
}
