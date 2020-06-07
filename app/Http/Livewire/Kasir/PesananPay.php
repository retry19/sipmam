<?php

namespace App\Http\Livewire\Kasir;

use App\Pesanan;
use Livewire\Component;

class PesananPay extends Component
{
    public $getId;
    public $no = 1;
    public $tax = 0.1;
    public $totalHargaWithTax;
    public $totalBayar;

    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function storePembayaran($formData)
    {
        $this->validate([
            'totalBayar' => 'required|gte:totalHargaWithTax'
        ], [
            'totalBayar.required' => 'Jumlah bayar harus diisi!.',
            'totalBayar.gte' => 'Jumlah bayar kurang!.',
        ]);

        $pesanan = Pesanan::find($this->getId);

        $pesanan->transaksi->total_bayar = $formData['totalBayar'];
        $pesanan->transaksi->kembali = $formData['kembali'];
        $pesanan->transaksi->status = 1;
        $pesanan->transaksi->save();
        
        $pesanan->status += 1;
        $pesanan->save();

        session()->flash('success', '<strong>Berhasil!</strong> pesanan telah dibayar.');

        return redirect()->route('kasir.pesanan-all');
    }

    public function resetTotalBayar()
    {
        $this->totalBayar = 0;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'totalBayar' => 'required|gte:totalHargaWithTax'
        ], [
            'totalBayar.required' => 'Jumlah bayar harus diisi!.',
            'totalBayar.gte' => 'Jumlah bayar kurang!.',
        ]);
    }

    public function mount($id)
    {
        $this->getId = $id;
    }

    public function render()
    {
        $pesanan = Pesanan::find($this->getId);

        $this->totalHargaWithTax = $pesanan->total_harga + $pesanan->total_harga * $this->tax;

        return view('livewire.kasir.pesanan-pay', [
            'pesanan' => $pesanan
        ]);
    }
}
