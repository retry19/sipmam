<?php

namespace App\Http\Livewire\Pelayan;

use Livewire\Component;

class CartIcon extends Component
{
    public $countOfCart = 0;
    public $cart = [];

    protected $listeners = ['menuSelected' => 'handleCountOfCart'];

    public function handleCountOfCart($id)
    {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);
        } else {
            $this->cart = array_diff($this->cart, array($id));
        }

        $this->countOfCart = count($this->cart);
    }

    public function render()
    {
        return view('livewire.pelayan.cart-icon');
    }
}
