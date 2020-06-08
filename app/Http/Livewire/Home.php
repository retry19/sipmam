<?php

namespace App\Http\Livewire;

use App\Menu;
use Livewire\Component;

class Home extends Component
{
    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function render()
    {
        $menus = Menu::all();

        return view('livewire.home', ['menus' => $menus]);
    }
}