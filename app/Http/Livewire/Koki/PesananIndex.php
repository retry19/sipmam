<?php

namespace App\Http\Livewire\Koki;

use App\Pesanan;
use Carbon\Carbon;
use Livewire\Component;

class PesananIndex extends Component
{
    public $no = 1;
    public $haha = 1;
    public $listProsesPesanan = [];

    protected $listeners = ['handleProsesPesanan'];

    public function handleProsesPesanan($id)
    {
        $pesanan = Pesanan::find($id);
        
        if ($pesanan->status < 1) {
            $pesanan->status = 1;
            $pesanan->save();

            $this->listProsesPesanan = Pesanan::where('status', '=', 1)->get();
        }
    }

    public function mount()
    {
        $_pesanan = Pesanan::where('status', '=', 1)->get();
        if (count($_pesanan) > 0) {
            $this->listProsesPesanan = $_pesanan;
        }
    }

    public function render()
    {
        $pesanan = Pesanan::whereDate('created_at', Carbon::today())->latest()->paginate(10);

        return view('livewire.koki.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
