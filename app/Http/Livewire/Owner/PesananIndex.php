<?php

namespace App\Http\Livewire\Owner;

use App\Pesanan;
use Livewire\Component;
use Livewire\WithPagination;
use Codedge\Fpdf\Fpdf\Fpdf;

class PesananIndex extends Component
{
    use WithPagination;

    public $no = 1;
    public $tglAwal;
    public $tglAkhir;
    public $showBy = '';

    public function printByDate($formData)
    {
        $pesanan = Pesanan::whereBetween('created_at', [$formData['tglAwal'], $formData['tglAkhir']])
                        ->get();

        $this->printPage($pesanan, $formData['tglAwal'], $formData['tglAkhir']);
    }
    
    public function printAll()
    {
        $pesanan = Pesanan::get();

        $this->printPage($pesanan);
    }

    private function printPage($data, $tglAwal = null, $tglAkhir = null)
    {
        ob_start();
        $fpdf = new Fpdf();
        
        $fpdf->AddPage('L');
        $fpdf->SetFont('Arial', 'B', 24);
        
        $fpdf->Cell(30, 10, 'Data Pesanan');
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
        $fpdf->Cell(15, 10, 'ID', 1, 0, 'C');
        $fpdf->Cell(30, 10, 'Pelayan', 1, 0, 'C');
        $fpdf->Cell(25, 10, 'No. Meja', 1, 0, 'C');
        $fpdf->Cell(50, 10, 'Total Harga', 1, 0, 'C');
        $fpdf->Cell(50, 10, 'Status', 1, 0, 'C');
        $fpdf->Cell(55, 10, 'Tanggal', 1, 0, 'C');
        $fpdf->Ln();
        
        $fpdf->SetFont('Arial', '', 14);
        
        // body
        foreach ($data as $p) {
            $fpdf->Cell(15, 10, $p->id, 1, 0, 'C');
            $fpdf->Cell(30, 10, $p->user->nama, 1);
            $fpdf->Cell(25, 10, $p->no_meja, 1, 0, 'C');
            $fpdf->Cell(50, 10, $p->totalHargaFormat, 1, 0, 'R');
            $fpdf->Cell(50, 10, $this->status($p->status), 1, 0, 'C');
            $fpdf->Cell(55, 10, $p->created_at, 1, 0, 'C');
            $fpdf->Ln();
        }

        $fpdf->Ln(10);
        $fpdf->Cell(30, 10, 'Tanggal Cetak : '.now());

        $fpdf->Output('', now()->format('Y-m-d').'-Data_Pesanan.pdf');
        ob_end_flush();
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
        $pesanan = null;

        if ($this->showBy == 'date') {
            $pesanan = Pesanan::whereBetween('created_at', [$this->tglAwal, $this->tglAkhir])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
        } else {
            $pesanan = Pesanan::orderBy('created_at', 'desc')
                            ->paginate(10);
        }

        return view('livewire.owner.pesanan-index', [
            'pesanan' => $pesanan
        ]);
    }
}
