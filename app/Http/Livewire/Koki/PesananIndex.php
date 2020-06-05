<?php

namespace App\Http\Livewire\Koki;

use App\Events\ServedPesanan;
use App\Notification;
use App\Pesanan;
use Carbon\Carbon;
use Livewire\Component;

class PesananIndex extends Component
{
    public $no = 1;
    public $haha = 1;
    public $listProsesPesanan = [];

    protected $listeners = [
        'echo:pelayan,OrderedPesanan' => 'notifyPesanan',
        'echo:pelayan,AddedPesanan' => 'notifyEditPesanan',
        'echo:pelayan,DeletedPesanan' => 'notifyEditPesanan'
    ];

    private function storeNotification($pesananId)
    {
        Notification::create([
            'pesanan_id' => $pesananId,
            'message' => 'Pesanan telah disajikan...',
            'role' => 'kasir',
            'aksi' => 0
        ]);
    }

    public function notifyPesanan($value)
    {
        session()->flash('info', '<strong>Pesanan Baru!</strong> telah ditambahkan.');
        return 0;
    }

    public function notifyEditPesanan($value)
    {
        session()->flash('info', '<strong>Pesanan Diubah!</strong>.');
        return 0;
    }

    public function handleProsesSelesai($id)
    {
        Pesanan::find($id)->update([
            'status' => 2
        ]);

        $this->storeNotification($id);
        event(new ServedPesanan($id));
        $this->refreshListProsesPesanan();

        session()->flash('success', '<strong>Selesai!</strong> Pesanan telah disajikan.');
    }

    public function handleProsesPesanan($id)
    {
        $pesanan = Pesanan::find($id);
        
        if ($pesanan->status < 1) {
            $pesanan->status = 1;
            $pesanan->save();
        
            $this->refreshListProsesPesanan();
        }
    }

    public function checkMenuKosong($pesanan)
    {
        foreach ($pesanan as $p) {
            if ($p->menu->kosong || $p->menu->jml_tersedia == $p->menu->jml_dipesan) {
                return true;
            }
        }

        return false;
    }

    public function generateClass($status)
    {
        $result = '';
        
        switch ($status) {
            case 0:
                break;
            case 1:
                $result = 'active';
                break;
            default:
                $result = 'done';
        }

        return $result;
    }

    private function refreshListProsesPesanan()
    {
        $this->listProsesPesanan = Pesanan::where('status', '=', 1)->get();
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
        $pesanan = Pesanan::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'ASC')
            ->orderBy('status', 'ASC')
            ->paginate(10);

        return view('livewire.koki.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
