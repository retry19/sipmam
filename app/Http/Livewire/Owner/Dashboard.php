<?php

namespace App\Http\Livewire\Owner;

use App\Menu;
use App\Pesanan;
use App\Transaksi;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $countPesanan;
    public $countMenu;
    public $avgPesananPerDay;
    public $totalBayar;
    public $kembali;
    public $chart;

    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function mount()
    {
        $this->countPesanan = Pesanan::whereMonth('created_at', now()->month)->count();
        $this->countMenu = Menu::count();
        $this->avgPesananPerDay = DB::select('SELECT COUNT(*) / COUNT(DISTINCT DATE(created_at)) AS rata FROM pesanan');
        $this->totalBayar = Transaksi::whereMonth('created_at', now()->month)->sum('total_bayar');
        $this->kembali = Transaksi::whereMonth('created_at', now()->month)->sum('kembali');
    }
    
    public function render()
    {
        return view('livewire.owner.dashboard');
    }
}
