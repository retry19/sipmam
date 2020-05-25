<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use Livewire\Component;

class CartList extends Component
{
    public $cart = [];
    public $cartDetail = [];

    protected $listeners = ['menuSelected' => 'handleShowCartList'];

    public function handleShowCartList($id)
    {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);
        } else {
            $this->cart = array_diff($this->cart, array($id));
        }
        
        $this->cartDetail = [];
        foreach ($this->cart as $c) {
            $menu = Menu::find($c, ['id', 'nama_menu', 'foto_menu', 'harga']);
            $arrMenu = [
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga
            ];

            array_push($this->cartDetail, $arrMenu);
        }
    }

    public function render()
    {
        return view('livewire.pelayan.cart-list');
    }
}
