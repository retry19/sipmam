<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use Livewire\Component;

class OrderIndex extends Component
{
    public $categorySelected = null;
    public $menuSearch = null;
    public $cart = [];

    protected $listeners = [
        'echo:koki,MenuEmpty' => 'notifyMenuEmpty',
        'menuSelected' => 'handleMenuSelected',
        'removeItemCart' => 'handleRemoveItem',
        'cancelOrder' => 'handleCancelOrder',
        'submitOrder' => 'handleSubmitOrder'
    ];

    public function notifyMenuEmpty($value)
    {
        return 0;
    }

    public function handleSubmitOrder($totalHarga)
    {
        $this->handleCancelOrder();

        session()->flash('success', '<strong>Selamat!</strong> Pemesanan makanan telah berhasil dilakukan.');
    }

    public function handleCancelOrder()
    {
        $this->cart = [];
    }

    public function handleMenuSelected($id) {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);
        } else {
            $this->cart = array_diff($this->cart, array($id));
        }
    } 

    public function handleCategorySelected($category) {
        $this->categorySelected = $category;
    }

    public function handleRemoveItem($id)
    {
        if (in_array($id, $this->cart)) {
            $this->cart = array_diff($this->cart, array($id));
        }
    }

    public function render()
    {
        if ($this->categorySelected != null) {
            $menus = Menu::where('jenis_menu', $this->categorySelected)->paginate(12);
        } else {
            $menus = Menu::paginate(12);
        }
        
        if ($this->menuSearch != null) {
            $menus = Menu::where('nama_menu', 'LIKE', "%{$this->menuSearch}%")->paginate(12);
            $this->categorySelected = null;
        }

        return view('livewire.pelayan.order-index', [
            'menus' => $menus
        ]);
    }
}
