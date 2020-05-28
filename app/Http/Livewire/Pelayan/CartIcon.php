<?php

namespace App\Http\Livewire\Pelayan;

use Livewire\Component;

class CartIcon extends Component
{
    public $countOfCart = 0;
    public $cart = [];

    protected $listeners = [
        'menuSelected' => 'handleCountOfCart',
        'removeItemCart' => 'handleRemoveItem',
        'cancelOrder' => 'handleCancelOrder',
        'submitOrder' => 'handleSubmitOrder'
    ];

    public function handleSubmitOrder($totalHarga)
    {
        $this->handleCancelOrder();
    }

    public function handleCancelOrder()
    {
        $this->countOfCart = 0;
        $this->cart = [];
    }

    public function handleCountOfCart($id)
    {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);
        } else {
            $this->cart = array_diff($this->cart, array($id));
        }

        $this->countOfCart = count($this->cart);
    }

    public function handleRemoveItem($id)
    {
        if (in_array($id, $this->cart))
            $this->cart = array_diff($this->cart, array($id));

        $this->countOfCart = count($this->cart);
    }

    public function render()
    {
        return view('livewire.pelayan.cart-icon');
    }
}
