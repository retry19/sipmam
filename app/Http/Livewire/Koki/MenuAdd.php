<?php

namespace App\Http\Livewire\Koki;

use App\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class MenuAdd extends Component
{
    public $namaMenu;
    public $jenisMenu;
    public $jmlTersedia;
    public $harga;
    public $fotoMenu;

    protected $listeners = ['fotoUpload' => 'handleFotoUpload'];

    public function handleFotoUpload($imgBase)
    {
        $this->fotoMenu = $imgBase;
    }

    public function storeMenu()
    {
        $this->validate([
            'namaMenu' => 'required|max:32',
            'jenisMenu' => 'required|in:makanan,minuman',
            'jmlTersedia' => 'required|numeric',
            'harga' => 'required|numeric',
            'fotoMenu' => 'required'
        ], [
            'namaMenu.required' => 'Nama menu wajib diisi!',
            'namaMenu.max' => 'Nama menu maksimal 32 huruf!',
            'jenisMenu.required' => 'Jenis menu wajib dipilih!',
            'jenisMenu.in' => 'Jenis menu wajib dipilih!',
            'jmlTersedia.required' => 'Jumlah stok tersedia wajib diisi!',
            'jmlTersedia.numeric' => 'Jumlah stok wajib angka!',
            'harga.required' => 'Harga tersedia wajib diisi!',
            'harga.numeric' => 'Harga wajib angka!',
            'fotoMenu.required' => 'Foto wajib diisi!',
        ]);

        $image = $this->storeImage($this->fotoMenu);

        Menu::create([
            'nama_menu' => $this->namaMenu,
            'foto_menu' => $image,
            'jenis_menu' => $this->jenisMenu,
            'jml_tersedia' => $this->jmlTersedia,
            'harga' => $this->harga
        ]);

        $this->resetForm();

        return session()->flash('success', '<strong>Berhasil!</strong> menu baru telah ditambahkan.');
    }

    private function storeImage($imgBase)
    {
        $img = Image::make($imgBase)->encode('jpg');
        
        $imageName = Str::random().'.jpg';
        Storage::disk('public')->put($imageName, $img);

        return $imageName;
    }

    private function resetForm() {
        $this->namaMenu = '';
        $this->jenisMenu = '';
        $this->jmlTersedia = '';
        $this->harga = '';
        $this->fotoMenu = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'namaMenu' => 'required|max:32',
            'jenisMenu' => 'required|in:makanan,minuman',
            'jmlTersedia' => 'required|numeric',
            'harga' => 'required|numeric',
            'fotoMenu' => 'required'
        ], [
            'namaMenu.required' => 'Nama menu wajib diisi!',
            'namaMenu.max' => 'Nama menu maksimal 32 huruf!',
            'jenisMenu.required' => 'Jenis menu wajib dipilih!',
            'jenisMenu.in' => 'Jenis menu wajib dipilih!',
            'jmlTersedia.required' => 'Jumlah stok tersedia wajib diisi!',
            'jmlTersedia.numeric' => 'Jumlah stok wajib angka!',
            'harga.required' => 'Harga tersedia wajib diisi!',
            'harga.numeric' => 'Harga wajib angka!',
            'fotoMenu.required' => 'Foto wajib diisi!',
        ]);
    }

    public function render()
    {
        return view('livewire.koki.menu-add');
    }
}
