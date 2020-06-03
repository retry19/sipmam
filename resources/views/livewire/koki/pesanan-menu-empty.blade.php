<div class="row">
    <div class="col-md-7">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Daftar Pesanan</h3>
            </div>
            <form wire:submit.prevent="storeMenuKosong">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Kosong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->detailPesanan as $p)
                            <tr>
                                <td scope="row" class="text-center">{{ $no++ }}</td>
                                <td>{{ $p->menu->nama_menu }}</td>
                                <td class="text-center">{{ $p->jml_pesan }}</td>
                                <td class="text-center">{{ $p->menu->jml_tersedia - $p->menu->jml_dipesan }}</td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input wire:model="kosong.{{ $p->menu_id }}" type="checkbox" class="form-check-input" value="{{ $p->menu_id }}" {{ $p->menu->kosong == 1 ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger float-right">
                    <i class="fas fa-check"></i> &nbsp;
                    Simpan
                </button>
            </div>
            </form>
        </div>
    </div>

</div>

@section('title', 'Edit Pesanan')
@section('pesanan', 'active')
@section('heading')
    <a href="{{ route('koki.pesanan-all') }}" class="btn btn-secondary p text-white"><i class="fas fa-angle-left"></i>&nbsp; Kembali</a> &nbsp; Edit Menu Kosong
@endsection
