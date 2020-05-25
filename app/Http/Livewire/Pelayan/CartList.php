<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use Livewire\Component;

class CartList extends Component
{
    public $cart = [];
    public $cartDetail = [];

    protected $listeners = [
        'menuSelected' => 'handleShowCartList',
        'removeItemCart' => 'handleRemoveItem'
    ];

    public function plusItem($id)
    {
        foreach ($this->cartDetail as $key => $item) {
            if ($item['id'] == $id) {
                $menu = Menu::find($id, ['jml_tersedia', 'jml_dipesan']);
                
                $qtyReady = $menu->jml_tersedia - $menu->jml_dipesan;
                
                if ($qtyReady > $item['qty']) {
                    $this->cartDetail[$key]['qty']++;
                }
            }
        }
    }

    public function minusItem($id)
    {
        foreach ($this->cartDetail as $key => $item) {
            if ($item['id'] == $id) {
                if ($item['qty'] > 1) {
                    $this->cartDetail[$key]['qty']--;
                }
            }
        }
    }

    public function handleRemoveItem($id)
    {
        if (in_array($id, $this->cart)) {
            $this->cart = array_diff($this->cart, array($id));

            foreach ($this->cartDetail as $key => $item) {
                if($item['id'] == $id) {
                    unset($this->cartDetail[$key]);
                }
            }
        }
    }

    public function handleShowCartList($id)
    {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);

            $menu = Menu::find($id, ['id', 'nama_menu', 'foto_menu', 'harga']);
            $arrMenu = [
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'qty' => 1
            ];

            array_push($this->cartDetail, $arrMenu);
        } else {
            $this->cart = array_diff($this->cart, array($id));

            foreach ($this->cartDetail as $key => $item) {
                if($item['id'] == $id) {
                    unset($this->cartDetail[$key]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.pelayan.cart-list');
    }
}
