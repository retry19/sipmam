<div class="row">
    @if(session()->has('info'))
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {!! session('info') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="col-md-3">
        <div class="list-menu">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text search-icon" id="search"><i class="fas fa-search"></i></span>
                    </div>
                    <input wire:model="mejaSearch" type="text" class="form-control search-field" placeholder="Cari meja..." aria-label="Cari meja..." aria-describedby="search">
                </div>
            </form>
            <ul>
                <li wire:click="handleStatusSelected(null)" 
                    class="{{ $statusSelected == null ? 'active' : '' }}">
                    Semua
                </li>
                <li wire:click="handleStatusSelected('proses')" 
                    class="{{ $statusSelected == 'proses' ? 'active' : '' }}">
                    Sedang Proses
                </li>
                <li wire:click="handleStatusSelected('selesai')" 
                    class="{{ $statusSelected == 'selesai' ? 'active' : '' }}">
                    Selesai
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 mt-3">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Daftar Pesanan</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">No. Meja</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pesanan) < 1)
                            <tr>
                                <td scope="row" colspan="6" class="text-center">
                                Tidak ada pesanan...
                                </td>
                            </tr>
                        @endif
                        @foreach ($pesanan as $item)
                            @php
                                $kosong = false;

                                foreach ($item->detailPesanan as $detail) :
                                    if ($detail->menu->kosong || $detail->menu->jml_tersedia <= $detail->menu->jml_dipesan) :
                                        $kosong = true;
                                    endif;
                                endforeach;
                            @endphp
                            <tr class="text-center">
                                <td scope="row">{{ $i++ }}</td>
                                <td>{{ $item->no_meja }}</td>
                                <td>Rp. {{ $item->total_harga }}</td>
                                <td>
                                    @if ($kosong)
                                        <span class="badge badge-danger">Terdapat Stok Kosong</span>
                                    @else
                                        @if ($item->status <= 1)
                                            <span class="badge badge-info">{{ $this->status($item->status) }}</span>
                                        @else
                                            <span class="badge badge-success">{{ $this->status($item->status) }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#detailModal" class="btn btn-sm btn-secondary" data-toggle="modal" data-pesanan="{{ $item->id }}">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    @if ($item->status <= 1)
                                        <a href="{{ route('pelayan.pesanan-edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $pesanan->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@section('title', 'Pesanan')
@section('pesanan', 'active')
@section('heading', 'Daftar Pesanan')

@section('js')
    <script>
        $('#detailModal').on('show.bs.modal', function(e) {
            let pesananId = $(e.relatedTarget).data('pesanan');

            $.ajax({
                method: 'GET',
                url: `http://localhost:8000/api/pesanan/${pesananId}/list`,
                success: function(res) {
                    let body = document.getElementById('table-body');
                    
                    while (body.hasChildNodes()) {  
                       body.removeChild(body.firstChild);
                    }

                    res.forEach(val => {
                        body.insertAdjacentHTML('beforeend', `
                            <tr class="text-center">
                                <td class="text-left">${val.nama_menu}</td>
                                <td>${val.jml_pesan}</td>
                                <td>Rp. ${val.harga}</td>
                                <td>Rp. ${val.harga * val.jml_pesan}</td>
                            </tr>
                        `);
                    });
                }
            });
        });
    </script>
@endsection
