<?php

namespace App\Http\Livewire\Koki;

use App\Events\MenuEmpty;
use App\Menu;
use App\Notification;
use App\Pesanan;
use Livewire\Component;

class PesananMenuEmpty extends Component
{
    public $pesananId;
    public $kosong = [];
    public $no = 1;

    private function storeNotification($pesananId, $menuId)
    {
        Notification::create([
            'pesanan_id' => $pesananId,
            'menu_id' => json_encode($menuId),
            'message' => 'Terdapat menu kosong, harap diganti...',
            'role' => 'pelayan',
            'aksi' => 1
        ]);
    }

    public function storeMenuKosong()
    {
        $menuIdKosong = array_keys(array_filter($this->kosong));
        
        Menu::whereIn('id', $menuIdKosong)->update([
            'kosong' => 1
        ]);

        event(new MenuEmpty($this->pesananId, $menuIdKosong));

        $this->storeNotification($this->pesananId, $menuIdKosong);

        session()->flash('success', '<strong>Berhasil!</strong> status menu berhasil diubah, menjadi kosong.');

        return redirect()->route('koki.pesanan-all');
    }

    public function mount($id)
    {
        $this->pesananId = $id;
    }

    public function render()
    {
        $pesanan = Pesanan::find($this->pesananId);

        return view('livewire.koki.pesanan-menu-empty', [
            'pesanan' => $pesanan
        ]);
    }
}
