<?php

namespace App\Http\Livewire\Kasir;

use App\Pesanan;
use Carbon\Carbon;
use Livewire\Component;

class PesananIndex extends Component
{
    public $no = 1;

    protected $listeners = ['echo:koki,ServedPesanan' => 'handleServedPesanan'];

    public function handleServedPesanan($value)
    {
        return $this->emit('notifSound');
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
        $pesanan = Pesanan::whereDate('created_at', Carbon::today())
                        ->orderBy('status', 'asc')
                        ->paginate(10);

        return view('livewire.kasir.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
