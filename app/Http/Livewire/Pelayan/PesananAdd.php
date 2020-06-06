<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use Livewire\Component;

class PesananAdd extends Component
{
    public $display;
    public $no = 1;
    public $jmlPesan = 1;

    protected $listeners = ['closePesananAdd' => 'togglePesananAdd'];

    public function addPesanan($id)
    {
        $this->emit('addPesanan', $id);
    }

    public function togglePesananAdd()
    {
        $this->display = !$this->display;
    }

    public function mount($isShow)
    {
        $this->display = $isShow;
    }

    public function render()
    {
        $menus = Menu::orderBy('nama_menu', 'asc')->paginate(10);

        return view('livewire.pelayan.pesanan-add', [
            'menus' => $menus
        ]);
    }
}
