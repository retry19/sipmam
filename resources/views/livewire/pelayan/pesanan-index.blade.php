<div class="row">
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
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover">
                <thead class="thead-light">
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
                        <tr class="text-center">
                            <td scope="row">{{ $i++ }}</td>
                            <td>{{ $item->no_meja }}</td>
                            <td>Rp. {{ $item->total_harga }}</td>
                            <td>
                                @if ($item->status <= 1)
                                    <span class="badge badge-info">
                                @else
                                    <span class="badge badge-success">
                                @endif
                                {{ $this->status($item->status) }}</span>
                            </td>
                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                            <td>
                                <a href="#detailModal" class="btn btn-sm btn-secondary" data-toggle="modal" data-pesanan="{{ $item->id }}">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="{{ route('pesanan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pesanan->links() }}
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
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Nama Menu</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="table-body"></tbody>
                        </table>
                        {{ $pesanan->links() }}
                    </div>
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
                url: `ajax/pesanan/${pesananId}/list`,
                success: function(res) {
                    // console.log(res);
                    let body = document.getElementById('table-body');
                    
                    while (body.hasChildNodes()) {  
                       body.removeChild(body.firstChild);
                    }

                    res.forEach(val => {
                        body.insertAdjacentHTML('beforeend', `
                            <tr class="text-center">
                                <td>${val.nama_menu}</td>
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
