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

    public function handleProsesPesanan($id)
    {
        if (!in_array($id, $this->listProsesPesanan)) {
            $this->haha += 1;
            $pesanan = Pesanan::find($id);

            $pesanan->status = 1;
            $pesanan->save();

            array_push($this->listProsesPesanan, $id);
        }
    }

    public function mount()
    {
        $this->listProsesPesanan = Pesanan::where('status', 1)->get(['id']);
    }

    public function render()
    {
        $pesanan = Pesanan::whereDate('created_at', Carbon::today())->latest()->paginate(10);

        return view('livewire.koki.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
