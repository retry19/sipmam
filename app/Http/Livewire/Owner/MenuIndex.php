<?php

namespace App\Http\Livewire\Owner;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MenuIndex extends Component
{
    public $no = 1;
    public $tglAwal;
    public $tglAkhir;
    public $showBy = '';

    public function printByDate($formData)
    {
        $pesanan = DB::table('pesanan')
                        ->selectRaw('menus.id, nama_menu, harga, SUM(jml_pesan) AS jml')
                        ->join('detail_pesanan', 'pesanan.id', '=', 'detail_pesanan.pesanan_id')
                        ->rightJoin('menus', 'detail_pesanan.menu_id', '=', 'menus.id')
                        ->groupByRaw('menus.id')
                        ->whereBetween('created_at', [$formData['tglAwal'], $formData['tglAkhir']])
                        ->get();

        $this->printPage($pesanan, $formData['tglAwal'], $formData['tglAkhir']);
    }
    
    public function printAll()
    {
        $pesanan = DB::table('pesanan')
                        ->selectRaw('menus.id, nama_menu, harga, SUM(jml_pesan) AS jml')
                        ->join('detail_pesanan', 'pesanan.id', '=', 'detail_pesanan.pesanan_id')
                        ->rightJoin('menus', 'detail_pesanan.menu_id', '=', 'menus.id')
                        ->groupByRaw('menus.id')
                        ->get();

        $this->printPage($pesanan);
    }

    private function printPage($data, $tglAwal = null, $tglAkhir = null)
    {
        ob_start();
        $fpdf = new Fpdf();

        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 24);
        
        $fpdf->Cell(30, 10, 'Data Transaksi');
        $fpdf->Ln();
        
        $fpdf->SetFont('Arial', '', 14);
        
        if ($tglAwal && $tglAkhir) {
            $fpdf->Cell(30, 10, 'Dari : '.$tglAwal);
            $fpdf->Ln();
            $fpdf->Cell(30, 10, 'Sampai : '.$tglAkhir);
        }
        
        $fpdf->Ln(25);

        // Header
        $fpdf->Cell(15, 10, 'ID', 1, 0, 'C');
        $fpdf->Cell(100, 10, 'Nama Menu', 1, 0, 'C');
        $fpdf->Cell(38, 10, 'Harga', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Jumlah Dipesan', 1, 0, 'C');
        $fpdf->Ln();

        // body
        foreach ($data as $p) {
            $fpdf->Cell(15, 10, $p->id, 1, 0, 'C');
            $fpdf->Cell(100, 10, $p->nama_menu, 1);
            $fpdf->Cell(38, 10, $this->hargaFormat($p->harga), 1, 0, 'R');
            $fpdf->Cell(40, 10, $p->jml ? $p->jml : 0, 1, 0, 'C');
            $fpdf->Ln();
        }

        $fpdf->Ln(10);
        $fpdf->Cell(30, 10, 'Tanggal Cetak : '.now());

        $fpdf->Output('', now()->format('Y-m-d').'-Data_Menu.pdf');
        ob_end_flush();
    }

    public function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function showByDate()
    {
        $this->validate([
            'tglAwal' => 'required',
            'tglAkhir' => 'required'
        ], [
            'tglAwal.required' => 'Tanggal awal harus diisi!.',
            'tglAkhir.required' => 'Tanggal akhir harus diisi!.'
        ]);

        $this->showBy = 'date';
    }

    public function showAll()
    {
        $this->showBy = '';
        $this->tglAwal = '';
        $this->tglAkhir = '';
    }

    public function render()
    {
        $pesanan = null;
        
        if ($this->showBy == 'date') {
            $pesanan = DB::table('pesanan')
                            ->selectRaw('menus.id, nama_menu, harga, SUM(jml_pesan) AS jml')
                            ->join('detail_pesanan', 'pesanan.id', '=', 'detail_pesanan.pesanan_id')
                            ->rightJoin('menus', 'detail_pesanan.menu_id', '=', 'menus.id')
                            ->groupByRaw('menus.id')
                            ->whereBetween('created_at', [$this->tglAwal, $this->tglAkhir])
                            ->get();
        } else {
            $pesanan = DB::table('pesanan')
                            ->selectRaw('menus.id, nama_menu, harga, SUM(jml_pesan) AS jml')
                            ->join('detail_pesanan', 'pesanan.id', '=', 'detail_pesanan.pesanan_id')
                            ->rightJoin('menus', 'detail_pesanan.menu_id', '=', 'menus.id')
                            ->groupByRaw('menus.id')
                            ->get();
        }

        return view('livewire.owner.menu-index', [
            'pesanan' => $pesanan
        ]);
    }
}
