<?php

namespace App\Http\Livewire\Pelayan;

use App\Pesanan;
use Carbon\Carbon;
use Livewire\Component;

class PesananIndex extends Component
{
    public $statusSelected = null;
    public $mejaSearch = null;
    public $i = 1;

    protected $listeners = ['echo:koki,MenuEmpty' => 'notifyMenuEmpty'];

    public function notifyMenuEmpty($value)
    {
        session()->flash('info', '<strong>Pesanan Kosong!</strong> Terdapat pesanan yang stoknya kosong.');
        return 0;
    }

    public function handleStatusSelected($status)
    {
        $this->statusSelected = $status;
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
        $pesanan = [];

        switch ($this->statusSelected) {
            case 'proses':
                $pesanan = Pesanan::whereDate('created_at', Carbon::today())->whereBetween('status', [0, 2])->latest()->paginate(10);
                break;
            case 'selesai':
                $pesanan = Pesanan::whereDate('created_at', Carbon::today())->where('status', '>', 2)->latest()->paginate(10);
                break;
            default:
                $pesanan = Pesanan::whereDate('created_at', Carbon::today())->latest()->paginate(10);
        }

        if ($this->mejaSearch != null) {
            $pesanan = Pesanan::whereDate('created_at', Carbon::today())->where('no_meja', $this->mejaSearch)->latest()->paginate(10);
        }
        
        return view('livewire.pelayan.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
