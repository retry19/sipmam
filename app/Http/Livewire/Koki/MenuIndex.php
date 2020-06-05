<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use Livewire\Component;
use Livewire\WithPagination;

class MenuIndex extends Component
{
    use WithPagination;

    public $no = 1;

    public function deleteMenu($id)
    {
        Menu::destroy($id);

        session()->flash('success', '<strong>Terhapus!</strong> menu telah dihapus.');

        return redirect()->route('koki.menu-all');
    }

    public function render()
    {
        $menus = Menu::paginate(10);

        return view('livewire.koki.menu-index', [
            'menus' => $menus
        ]);
    }
}
