<div class="row">
    <div class="col-md-5">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Detail Pesanan</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->detailPesanan as $dp)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $dp->menu->nama_menu }}</td>
                                <td class="text-center">{{ $dp->jml_pesan }}</td>
                                <td>{{ $dp->menu->hargaFormat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Pesanan</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" disabled value="{{ $pesanan->dateFormat }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">No. Meja</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" disabled value="{{ $pesanan->no_meja }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Pelayan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" disabled value="{{ $pesanan->user->nama }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card shadow-none">
            <div class="card-header bg-primary">
                <h3 class="card-title">Pembayaran</h3>
            </div>
            <div class="card-body">
                <h1 class="text-right">{{ $this->hargaFormat($totalHargaWithTax) }}</h1>
                <input type="hidden" id="totalHargaWithTax" value="{{ $totalHargaWithTax }}">
            </div>
        </div>

        <div class="card shadow-none">
            <div class="card-body row">
                <div class="offset-md-6 col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-right" disabled value="{{ $this->hargaFormat($pesanan->total_harga) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Pajak ({{ $tax * 100 }}%)</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-right" disabled value="{{ $this->hargaFormat($pesanan->total_harga * $tax) }}">
                        </div>
                    </div>
                    
                    <hr>
                    
                    <form wire:submit.prevent="storePembayaran(Object.fromEntries(new FormData($event.target)))">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Bayar</label>
                            <div class="col-sm-8">
                                <input wire:model.debounce.500ms="totalBayar" wire:loading.attr="disabled" wire:target="storePembayaran" type="number" name="totalBayar" min="0" class="form-control text-right" id="totalBayar">
                                @error('totalBayar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Kembali</label>
                            <div class="col-sm-8">
                                <input type="text" name="kembali" class="form-control text-right" id="kembali" readonly>
                            </div>
                        </div>
    
                        <div class="pt-3 text-right">
                            <button type="submit" wire:loading.class="disabled" class="btn btn-lg btn-primary">
                                <span wire:loading wire:target="storePembayaran" class="spinner-border spinner-border-lg" aria-hidden="true"></span>
                                <span wire:loading.remove wire:target="storePembayaran">Bayar Pesanan</span>
                            </button>&nbsp;
                            <button wire:click="resetTotalBayar" type="button" wire:loading.class="disabled" wire:target="storePembayaran" class="btn btn-lg btn-outline-secondary">Reset</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    function inputBayar() {
        let totalBayar = document.getElementById('totalBayar').value;
        console.log(totalBayar);
    }
    
    let input = document.getElementById('totalBayar');
    let totalHargaWithTax = document.getElementById('totalHargaWithTax').value;
    let kembali = document.getElementById('kembali');

    input.addEventListener('keyup', function () {
        kembali.value = input.value - totalHargaWithTax;
    });
    
</script>

@section('title', 'Pembayaran')
@section('pesanan', 'active')
@section('heading')
    <a href="{{ route('kasir.pesanan-all') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-angle-left"></i>&nbsp;
        Kembali
    </a>&nbsp;
    Pembayaran
@endsection
