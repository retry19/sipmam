<div class="row">
    <div class="col-md-12">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Tampil Data</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input wire:model="tglAwal" type="text" class="form-control" placeholder="Tanggal awal" onfocus="(this.type='date')" onblur="(this.type='text')">
                        @error('tglAwal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <input wire:model="tglAkhir" type="text" class="form-control" placeholder="Tanggal akhir" onfocus="(this.type='date')" onblur="(this.type='text')">
                        @error('tglAkhir')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="form-group">
                        <button wire:click="showByDate" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i>&nbsp;
                            Tampilkan per-tanggal
                        </button> &nbsp;
                    </div>
                    <div class="form-group">
                        <button wire:click="showAll" class="btn btn-outline-secondary">Tampilkan semua</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Menu</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Jumlah dipesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan as $p)
                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td class="text-left">{{ $p->nama_menu }}</td>
                                    <td class="text-right">{{ $this->hargaFormat($p->harga) }}</td>
                                    <td>{{ $p->jml ? $p->jml : 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Cetak Data</h3>
                <a href="{{ route('owner.menu-all') }}" class="btn btn-sm btn-outline-secondary float-right">
                    Reset
                </a>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="printByDate(Object.fromEntries(new FormData($event.target)))" class="form-row">
                    <div class="form-group col-md-3">
                        <input name="tglAwal" type="text" class="form-control" placeholder="Tanggal awal" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>
                    <div class="form-group col-md-3">
                        <input name="tglAkhir" type="text" class="form-control" placeholder="Tanggal akhir" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i>&nbsp;
                            Cetak per-tanggal
                        </button> &nbsp;
                    </div>
                    <div class="form-group">
                        <button wire:click="printAll" class="btn btn-outline-secondary">
                            <i class="fas fa-download"></i>&nbsp;
                            Cetak semua
                        </button>
                    </div>    
                </form>
            </div>
        </div>
    </div> 
</div>

@section('title', 'Data Menu')
@section('menu', 'active')
@section('heading', 'Data Menu')
