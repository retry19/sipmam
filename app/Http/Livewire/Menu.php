<?php

namespace App\Http\Livewire;

use App\Menu as AppMenu;
use Livewire\Component;

class Menu extends Component
{
    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function render()
    {
        $menus = AppMenu::all();

        return view('livewire.menu', ['menus' => $menus]);
    }
}
