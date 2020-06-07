<?php

namespace App\Http\Livewire\Owner;

use App\Transaksi;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiIndex extends Component
{
    use WithPagination;

    public $tglAwal;
    public $tglAkhir;
    public $showBy = '';
    public $totalPemasukan = 0;

    public function printByDate($formData)
    {
        $transaksi = Transaksi::whereBetween('created_at', [$formData['tglAwal'], $formData['tglAkhir']])
                        ->get();

        $this->printPage($transaksi, $formData['tglAwal'], $formData['tglAkhir']);
    }
    
    public function printAll()
    {
        $transaksi = Transaksi::get();

        $this->printPage($transaksi);
    }

    private function printPage($data, $tglAwal = null, $tglAkhir = null)
    {
        ob_start();
        $fpdf = new Fpdf();

        $fpdf->AddPage('L');
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
        $fpdf->SetFont('Arial', 'B', 14);
        
        // Header
        $fpdf->Cell(35, 10, 'ID', 1, 0, 'C');
        $fpdf->Cell(50, 10, 'Total Bayar', 1, 0, 'C');
        $fpdf->Cell(50, 10, 'Kembali', 1, 0, 'C');
        $fpdf->Cell(40, 10, 'Status', 1, 0, 'C');
        $fpdf->Cell(55, 10, 'Waktu', 1, 0, 'C');
        $fpdf->Ln();

        $fpdf->SetFont('Arial', '', 14);

        // body
        foreach ($data as $p) {
            $fpdf->Cell(35, 10, $p->id, 1, 0, 'C');
            $fpdf->Cell(50, 10, $this->hargaFormat($p->total_bayar), 1, 0, 'R');
            $fpdf->Cell(50, 10, $this->hargaFormat($p->kembali), 1, 0, 'R');
            $fpdf->Cell(40, 10, $p->status < 1 ? 'Belum bayar' : 'Sudah bayar', 1, 0, 'C');
            $fpdf->Cell(55, 10, $p->created_at, 1, 0, 'C');
            $fpdf->Ln();
        }

        $fpdf->Ln(10);
        $fpdf->Cell(30, 10, 'Tanggal Cetak : '.Carbon::now());

        $fpdf->Output('', Carbon::now()->format('Y-m-d').'-Data_Transaksi.pdf');
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
        $transaksi = null;

        if ($this->showBy == 'date') {
            $transaksi = Transaksi::whereBetween('created_at', [$this->tglAwal, $this->tglAkhir])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        } else {
            $transaksi = Transaksi::orderBy('created_at', 'desc')
                            ->paginate(10);
        }

        return view('livewire.owner.transaksi-index', [
            'transaksi' => $transaksi
        ]);
    }
}
