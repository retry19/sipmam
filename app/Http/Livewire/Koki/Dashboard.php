<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use App\Pesanan;
use Livewire\Component;

class Dashboard extends Component
{
    public $countPesanan;
    public $countMenuEmpty;

    public function mount()
    {
        $this->countPesanan = Pesanan::whereDate('created_at', now())->count();
        $this->countMenuEmpty = Menu::where('jml_tersedia', '<=', 'jml_dipesan')
                                    ->orWhere('kosong', 1)
                                    ->count();
    }

    public function render()
    {
        return view('livewire.koki.dashboard');
    }
}
