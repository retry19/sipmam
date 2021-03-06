<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MenuEdit extends Component
{
    public $getId;
    public $namaMenu;
    public $jenisMenu;
    public $jmlTersedia;
    public $jmlDipesan;
    public $harga;
    public $kosong;
    public $fotoMenu;
    public $fotoMenuOld;

    protected $listeners = ['fotoUpdateUpload' => 'handleFotoUpload'];

    public function handleFotoUpload($imgBase)
    {
        $this->fotoMenu = $imgBase;
    }

    public function updateMenu()
    {
        $this->validate([
            'namaMenu' => 'required|max:32',
            'jenisMenu' => 'required|in:makanan,minuman',
            'jmlTersedia' => 'required|numeric',
            'jmlDipesan' => 'numeric',
            'harga' => 'required|numeric',
        ], [
            'namaMenu.required' => 'Nama menu wajib diisi!',
            'namaMenu.max' => 'Nama menu maksimal 32 huruf!',
            'jenisMenu.required' => 'Jenis menu wajib dipilih!',
            'jenisMenu.in' => 'Jenis menu wajib dipilih!',
            'jmlTersedia.required' => 'Jumlah stok tersedia wajib diisi!',
            'jmlTersedia.numeric' => 'Jumlah stok wajib angka!',
            'jmlDipesan.numeric' => 'Jumlah dipesan wajib angka!',
            'harga.required' => 'Harga tersedia wajib diisi!',
            'harga.numeric' => 'Harga wajib angka!',
        ]);

        $image = $this->storeImage($this->fotoMenu);

        $menu = Menu::find($this->getId);

        $menu->nama_menu = $this->namaMenu;

        if ($image) {
            Storage::disk('public')->delete($menu->foto_menu);
            $menu->foto_menu = $image;
        }

        $menu->jenis_menu = $this->jenisMenu;
        $menu->jml_tersedia = $this->jmlTersedia;
        $menu->jml_dipesan = $this->jmlDipesan ? $this->jmlDipesan : 0;
        $menu->harga = $this->harga;
        $menu->kosong = $this->kosong ? true : false;

        $menu->save();

        session()->flash('success', '<strong>Berhasil!</strong> menu berhasil diubah.');
        
        return redirect()->route('koki.menu-all'); 
    }

    private function storeImage($imgBase)
    {
        if (!$imgBase) 
            return null;
        
        $img = Image::make($imgBase)->encode('jpg');
        
        $imageName = Str::random().'.jpg';
        Storage::disk('public')->put($imageName, $img);

        return $imageName;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'namaMenu' => 'required|max:32',
            'jenisMenu' => 'required|in:makanan,minuman',
            'jmlTersedia' => 'required|numeric',
            'jmlDipesan' => 'numeric',
            'harga' => 'required|numeric',
        ], [
            'namaMenu.required' => 'Nama menu wajib diisi!',
            'namaMenu.max' => 'Nama menu maksimal 32 huruf!',
            'jenisMenu.required' => 'Jenis menu wajib dipilih!',
            'jenisMenu.in' => 'Jenis menu wajib dipilih!',
            'jmlTersedia.required' => 'Jumlah stok tersedia wajib diisi!',
            'jmlTersedia.numeric' => 'Jumlah stok wajib angka!',
            'jmlDipesan.numeric' => 'Jumlah dipesan wajib angka!',
            'harga.required' => 'Harga tersedia wajib diisi!',
            'harga.numeric' => 'Harga wajib angka!',
        ]);
    }

    public function mount($id)
    {
        $this->getId = $id;

        $this->setDataFromDB($id);
    }

    private function setDataFromDB($id) {
        $menu = Menu::find($id);
    
        $this->namaMenu = $menu->nama_menu;
        $this->jenisMenu = $menu->jenis_menu;
        $this->jmlTersedia = $menu->jml_tersedia;
        $this->jmlDipesan = $menu->jml_dipesan;
        $this->harga = $menu->harga;
        $this->kosong = $menu->kosong;
        $this->fotoMenuOld = $menu->foto_menu;
    }
    
    public function render()
    {
        return view('livewire.koki.menu-edit');
    }
}
