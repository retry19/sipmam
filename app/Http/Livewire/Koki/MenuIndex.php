<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class MenuIndex extends Component
{
    use WithPagination;

    public $no = 1;

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);

        Storage::disk('public')->delete($menu->foto_menu);
        $menu->delete();

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
