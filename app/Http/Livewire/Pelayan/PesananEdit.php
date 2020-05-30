<?php

namespace App\Http\Livewire\Pelayan;

use App\DetailPesanan;
use App\Menu;
use App\Pesanan;
use Livewire\Component;

class PesananEdit extends Component
{
    public $no = 1;
    public $getId;
    public $listPesanan;
    public $pesananId;
    public $totalHarga = 0;
    public $showPesananAdd = false;

    protected $listeners = [
        'closePesananAdd' => 'togglePesananAdd',
        'addPesanan' => 'handleAddPesanan'
    ];

    public function handleAddPesanan($id)
    {
        $menu = Menu::find($id, ['jml_tersedia', 'jml_dipesan', 'harga']);
    
        if ($menu->jml_tersedia > $menu->jml_dipesan) {
            
            $lastIdPesananStatus = false;

            foreach ($this->listPesanan as $key => $item) {
                if ($item['menu_id'] == $id) {
                    $this->listPesanan[$key]['jml_pesan'] += 1;    

                    DetailPesanan::where('id', $item['id'])->update([
                        'jml_pesan' => $this->listPesanan[$key]['jml_pesan']
                    ]);

                    Menu::find($item['menu_id'])->update([
                        'jml_dipesan' => $menu->jml_dipesan + 1
                    ]);

                    $pesanan = Pesanan::find($this->listPesanan[0]['pesanan_id']);

                    $pesanan->total_harga += $menu->harga;
                    $pesanan->save();

                    $lastIdPesananStatus = true;
                }
            }

            if (!$lastIdPesananStatus) {
                DetailPesanan::create([
                    'pesanan_id' => $this->listPesanan[0]['pesanan_id'],
                    'menu_id' => $id,
                    'jml_pesan' => 1
                ]);

                Menu::find($id)->update([
                    'jml_dipesan' => $menu->jml_dipesan + 1
                ]);

                $pesanan = Pesanan::find($this->listPesanan[0]['pesanan_id']);

                $pesanan->total_harga += $menu->harga;
                $pesanan->save();
            }
        }
    }

    public function togglePesananAdd()
    {
        $this->showPesananAdd = !$this->showPesananAdd;
    }

    public function deletePesanan($id)
    {
        foreach ($this->listPesanan as $key => $item) {
            if($item['id'] == $id) {
                $menu = Menu::find($item['menu_id'], ['jml_dipesan']);
                $pesanan = Pesanan::find($this->getId);

                if ($item['jml_pesan'] > 1) {
                    $this->listPesanan[$key]['jml_pesan'] -= 1;
                    
                    DetailPesanan::where('id', $id)->update([
                        'jml_pesan' => $this->listPesanan[$key]['jml_pesan']
                    ]);

                    Menu::find($item['menu_id'])->update([
                        'jml_dipesan' => $menu->jml_dipesan - 1
                    ]);

                    $pesanan->total_harga -= $item['harga'];
                    $pesanan->save();
                } else {
                    unset($this->listPesanan[$key]);

                    DetailPesanan::destroy($id);

                    Menu::find($item['menu_id'])->update([
                        'jml_dipesan' => $menu->jml_dipesan - 1
                    ]);

                    $pesanan->total_harga -= $item['harga'];
                    $pesanan->save();
                }

            }
        }

        if (count($this->listPesanan) < 1) {
            Pesanan::destroy($this->getId);

            return redirect()->route('pesanan.index');
        }
    }

    private function getDetailPesanan($id) {
        $listPesanan = DetailPesanan::where('pesanan_id', $id)->get();

        $list = [];

        foreach ($listPesanan as $pesanan) {
            $menu = Menu::find($pesanan->menu_id, ['id', 'nama_menu', 'harga']);
            
            $arrPesanan = [
                'id' => $pesanan->id,
                'pesanan_id' => $pesanan->pesanan_id,
                'menu_id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'jml_pesan' => $pesanan->jml_pesan,
            ];

            array_push($list, $arrPesanan);
        }

        return $list;
    }

    public function mount($id)
    {
        $this->getId = $id;
    }

    public function render()
    {   
        $this->listPesanan = $this->getDetailPesanan($this->getId);

        return view('livewire.pelayan.pesanan-edit');
    }
}
