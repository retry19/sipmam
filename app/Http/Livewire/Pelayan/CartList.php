<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use App\DetailPesanan;
use App\Pesanan;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartList extends Component
{
    public $cart = [];
    public $cartDetail = [];
    public $noMeja;
    public $validNoMeja = 0;

    protected $listeners = [
        'menuSelected' => 'handleShowCartList',
        'removeItemCart' => 'handleRemoveItem',
        'cancelOrder' => 'handleCancelOrder',
        'submitOrder' => 'handleSubmitOrder',
    ];

    public function updated($field)
    {
        if ($this->noMeja != null) {
            $this->validNoMeja = Pesanan::whereDate('created_at', Carbon::today())
                ->where('no_meja', $this->noMeja)
                ->count();
        }
    }


    public function handleSubmitOrder($totalHarga)
    {
        try {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->no_meja = $this->noMeja;
            $pesanan->total_harga = $totalHarga;
            $pesanan->save();
        } catch (\Exception $e) {
            throw $e;
        }

        foreach ($this->cartDetail as $item) {
            try {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item['id'],
                    'jml_pesan' => $item['qty']
                ]);

                $menu = Menu::find($item['id']);     

                $menu->jml_dipesan += $item['qty'];
                $menu->save();
            } catch (\Exception $e) {
                throw $e;
            }
        }
        $this->handleCancelOrder();

        return redirect()->route('pelayan.order');
    }

    public function handleCancelOrder()
    {
        $this->cart = [];
        $this->cartDetail = [];
    }

    public function plusItem($id)
    {
        foreach ($this->cartDetail as $key => $item) {
            if ($item['id'] == $id) {
                $menu = Menu::find($id, ['jml_tersedia', 'jml_dipesan']);
                
                $qtyReady = $menu->jml_tersedia - $menu->jml_dipesan;
                
                if ($qtyReady > $item['qty']) {
                    $this->cartDetail[$key]['qty']++;
                }
            }
        }
    }

    public function minusItem($id)
    {
        foreach ($this->cartDetail as $key => $item) {
            if ($item['id'] == $id) {
                if ($item['qty'] > 1) {
                    $this->cartDetail[$key]['qty']--;
                }
            }
        }
    }

    public function handleRemoveItem($id)
    {
        if (in_array($id, $this->cart)) {
            $this->cart = array_diff($this->cart, array($id));

            foreach ($this->cartDetail as $key => $item) {
                if($item['id'] == $id) {
                    unset($this->cartDetail[$key]);
                }
            }
        }
    }

    public function handleShowCartList($id)
    {
        if (!in_array($id, $this->cart)) {
            array_push($this->cart, $id);

            $menu = Menu::find($id, ['id', 'nama_menu', 'foto_menu', 'harga']);
            $arrMenu = [
                'id' => $menu->id,
                'nama_menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'qty' => 1
            ];

            array_push($this->cartDetail, $arrMenu);
        } else {
            $this->cart = array_diff($this->cart, array($id));

            foreach ($this->cartDetail as $key => $item) {
                if($item['id'] == $id) {
                    unset($this->cartDetail[$key]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.pelayan.cart-list');
    }
}
