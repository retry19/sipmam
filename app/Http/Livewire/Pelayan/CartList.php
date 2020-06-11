<?php

namespace App\Http\Livewire\Pelayan;

use App\Menu;
use App\DetailPesanan;
use App\Events\OrderedPesanan;
use App\Notification;
use App\Pesanan;
use App\Transaksi;
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
    ];

    public function updated($field)
    {
        if ($this->noMeja != null) {
            $this->validNoMeja = Pesanan::whereDate('created_at', Carbon::today())
                ->where('status', '<', 3)
                ->where('no_meja', $this->noMeja)
                ->count();
        }
    }

    private function storeNotification($id)
    {
        Notification::create([
            'pesanan_id' => $id,
            'message' => 'Pesanan baru telah ditambahkan...',
            'role' => 'koki',
            'aksi' => 0
        ]);
    }

    public function submitOrder($totalHarga)
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

        try {
            $count = Transaksi::whereDate('created_at', Carbon::today())
                        ->count();
            $countId = $count + 1;

            $strId = substr('000'.$countId, -3);

            $transaksiId = 'T'.Carbon::today()->format('Ym').$strId;
            
            Transaksi::create([
                'id' => $transaksiId,
                'pesanan_id' => $pesanan->id,
            ]);
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

        event(new OrderedPesanan($pesanan->id));
        
        $this->storeNotification($pesanan->id);
        
        $this->handleCancelOrder();
        $this->emit('submitOrder', $totalHarga);
    }

    public function handleCancelOrder()
    {
        $this->noMeja = '';
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
