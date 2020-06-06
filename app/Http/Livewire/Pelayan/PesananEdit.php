<?php

namespace App\Http\Livewire\Pelayan;

use App\DetailPesanan;
use App\Events\AddedPesanan;
use App\Events\DeletedPesanan;
use App\Notification;
use App\Pesanan;
use Livewire\Component;

class PesananEdit extends Component
{
    public $no = 1;
    public $getId;
    public $listPesanan;
    public $pesananCount;
    public $pesananId;
    public $totalHarga = 0;
    public $showPesananAdd = false;

    protected $listeners = [
        'closePesananAdd' => 'togglePesananAdd',
        'addPesanan' => 'handleAddPesanan'
    ];

    private function storeNotification($type, $pesananId, $menuId)
    {
        Notification::create([
            'pesanan_id' => $pesananId,
            'menu_id' => json_encode($menuId),
            'message' => $type == 'add' ? 'Pesanan telah diubah dan ditambahkan...' : 'Pesanan telah diubah dan dihapus...',
            'role' => 'koki',
            'aksi' => 0
        ]);
    }

    public function deletePesanan($id)
    {
        $detailPesanan = DetailPesanan::find($id);
        
        if ($detailPesanan->jml_pesan > 1) {
            $detailPesanan->jml_pesan -= 1;
            $detailPesanan->save();
        } else {
            $detailPesanan->delete();
        }

        $detailPesanan->menu->jml_dipesan -= 1;
        $detailPesanan->menu->save();

        $this->listPesanan->total_harga -= $detailPesanan->menu->harga;
        $this->listPesanan->save();

        $this->pesananCount = DetailPesanan::where('pesanan_id', $this->getId)->count();

        // if ($this->pesananCount < 1) {
        //     Pesanan::find($this->getId)
        //         ->delete();

        //     session()->flash('success', '<strong>Selamat!</strong> Pesanan berhasil dihapus.');
        //     return redirect()->route('pelayan.pesanan-all');
        // }

        event(new DeletedPesanan($this->getId, $id));

        $this->storeNotification('delete', $this->getId, $id);

        session()->flash('success', '<strong>Selamat!</strong> Pesanan berhasil dihapus.');
       
        $this->refreshListPesanan();
        // return redirect()->route('pelayan.pesanan-edit', $this->getId);
    }

    public function handleAddPesanan($id)
    {
        $isMenuOnPesanan = DetailPesanan::where('pesanan_id', $this->getId)
                                ->where('menu_id', $id)
                                ->count();

        if (!$isMenuOnPesanan) {
            $newDetailPesanan = new DetailPesanan();

            $newDetailPesanan->pesanan_id = $this->getId;
            $newDetailPesanan->menu_id = $id;
            $newDetailPesanan->jml_pesan = 1;

            $newDetailPesanan->save();

            $newDetailPesanan->menu->jml_dipesan += 1;
            $newDetailPesanan->menu->save();

            $this->listPesanan->total_harga += $newDetailPesanan->menu->harga;
            $this->listPesanan->save();
        } else {
            $detailPesanan = DetailPesanan::where('pesanan_id', $this->getId)
                                ->where('menu_id', $id)
                                ->first();
                                
            $detailPesanan->jml_pesan += 1;
            $detailPesanan->save();

            $detailPesanan->menu->jml_dipesan += 1;
            $detailPesanan->menu->save();
            
            $this->listPesanan->total_harga += $detailPesanan->menu->harga;
            $this->listPesanan->save();
        }

        event(new AddedPesanan($this->getId, $id));

        $this->storeNotification('add', $this->getId, $id);

        session()->flash('success', '<strong>Selamat!</strong> Pesanan berhasil ditambahkan.');

        return $this->refreshListPesanan();
        // return redirect()->route('pelayan.pesanan-edit', $this->getId);
    }

    private function refreshListPesanan() {
        $this->listPesanan = Pesanan::find($this->getId);
    }

    public function togglePesananAdd()
    {
        $this->showPesananAdd = !$this->showPesananAdd;
    }

    public function mount($id)
    {
        $this->getId = $id;
        $this->pesananCount = DetailPesanan::where('pesanan_id', $id)->count();
    }

    public function render()
    {   
        $this->listPesanan = Pesanan::find($this->getId);

        return view('livewire.pelayan.pesanan-edit');
    }
}
