<?php

namespace App\Http\Livewire\Kasir;

use App\Pesanan;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Livewire\Component;

class PesananIndex extends Component
{
    public $no = 1;

    protected $listeners = ['echo:koki,ServedPesanan' => 'handleServedPesanan'];

    public function handleServedPesanan($value)
    {
        return $this->emit('notifSound');
    }

    public function printInvoice($id)
    {
        ob_start();
        $fpdf = new Fpdf();

        $pesanan = Pesanan::find($id);

        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 24);
        
        $fpdf->Cell(30, 10, 'Invoice Transaksi');
        $fpdf->Ln();
        
        $fpdf->SetFont('Arial', '', 14);
        
        $fpdf->Cell(30, 10, 'ID : '.$pesanan->transaksi->id);
        $fpdf->Ln(20);
        
        $fpdf->SetFont('Arial', 'B', 14);
        // Header
        $fpdf->Cell(15, 10, 'No', 1, 0, 'C');
        $fpdf->Cell(100, 10, 'Nama Menu', 1, 0, 'C');
        $fpdf->Cell(20, 10, 'Jumlah', 1, 0, 'C');
        $fpdf->Cell(38, 10, 'Harga', 1, 0, 'C');
        $fpdf->Ln();
        
        $fpdf->SetFont('Arial', '', 14);
        $totalHarga = 0;
        $no = 1;

        // body
        foreach ($pesanan->detailPesanan as $dp) {
            $fpdf->Cell(15, 10, $no++, 1, 0, 'C');
            $fpdf->Cell(100, 10, $dp->menu->nama_menu, 1);
            $fpdf->Cell(20, 10, $dp->jml_pesan, 1, 0, 'C');
            $fpdf->Cell(38, 10, $this->hargaFormat($dp->menu->harga), 1, 0, 'R');
            $fpdf->Ln();

            $totalHarga += $dp->menu->harga;
        }

        // footer
        $fpdf->Cell(135, 10, 'Total Harga', 1, 0, 'R');
        $fpdf->Cell(38, 10, $this->hargaFormat($totalHarga), 1, 0, 'R');
        $fpdf->Ln();
        $fpdf->Cell(135, 10, 'Pajak (10%)', 1, 0, 'R');
        $fpdf->Cell(38, 10, $this->hargaFormat($totalHarga * 0.1), 1, 0, 'R');
        $fpdf->Ln();

        $fpdf->SetFont('Arial', 'B', 14);
        $fpdf->Cell(135, 20, 'Bayar', 1, 0, 'R');
        $fpdf->Cell(38, 20, $this->hargaFormat($totalHarga + ($totalHarga * 0.1)), 1, 0, 'R');
        $fpdf->Ln();

        $fpdf->SetFont('Arial', '', 14);
        $fpdf->Ln(10);
        $fpdf->Cell(30, 10, 'Tanggal Cetak : '.now());

        $fpdf->Output('', $pesanan->transaksi->id.'-Invoice.pdf');
        ob_end_flush();
    }

    private function hargaFormat($price)
    {
        return 'Rp. '.number_format($price, 2, ',', '.');
    }

    public function status($status) {
        $result = '';
        switch ($status) {
            case 0:
                $result = 'Menunggu koki';
                break;
            case 1:
                $result = 'Sedang dimasak koki';
                break;
            case 2:
                $result = 'Telah dihidangkan';
                break;
            default:
                $result = 'Pesanan selesai';
                break;
        }

        return $result;
    }

    public function render()
    {
        $pesanan = Pesanan::whereDate('created_at', Carbon::today())
                        ->orderBy('status', 'asc')
                        ->paginate(10);

        return view('livewire.kasir.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
