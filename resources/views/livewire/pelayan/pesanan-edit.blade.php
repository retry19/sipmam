<div class="row">
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailPesanan as $item)
                        <tr>
                            <td scope="row" class="text-center">{{ $i++ }}</td>
                            <td>{{ $item['nama_menu'] }}</td>
                            <td class="text-center">{{ $item['jml_pesan'] }}</td>
                            <td>Rp. {{ $item['harga'] }}</td>
                            <td>Rp. {{ $item['harga'] * $item['jml_pesan'] }}</td>
                            <td>
                                <a wire:click="editPesanan({{ $item['id'] }})" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <button type="button" data-target="#modalDeletePesanan" class="btn btn-sm btn-danger" data-toggle="modal" data-id="{{ $item['id'] }}" data-menu="{{ $item['nama_menu'] }}" data-jml="{{ $item['jml_pesan'] }}"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDeletePesanan" tabindex="-1" role="dialog" aria-labelledby="modalDeletePesananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeletePesananLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body" id="modal-body"></div>
                    <div class="modal-footer" id="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>

</div>

@section('title', 'Edit Pesanan')
@section('pesanan', 'active')
@section('heading')
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary p text-white"><i class="fas fa-angle-left"></i>&nbsp; Kembali</a> &nbsp; Edit Pesanan
@endsection

@section('js')
    <script>
        $('#modalDeletePesanan').on('show.bs.modal', function(e) {
            let pesananId = $(e.relatedTarget).data('id');
            let namaMenu = $(e.relatedTarget).data('menu');
            let jmlPesan = $(e.relatedTarget).data('jml');

            let body = document.getElementById('modal-body');
            while (body.hasChildNodes()) {  
                body.removeChild(body.firstChild);
            }

            let footer = document.getElementById('modal-footer');
            while (footer.hasChildNodes()) {  
                footer.removeChild(footer.firstChild);
            }

            body.insertAdjacentHTML('beforeend', `
                <p>Apakah anda yakin akan menghapus pesanan :</p>
                <p class="h5">${namaMenu}</p>
                <div class="form-group">
                    <label class="col-form-label">Jumlah dihapus :</label>
                    <input type="number" name="jmlHapus" class="form-control w-50" min="1" value="${jmlPesan}">
                    <input type="hidden" name="id" value="${pesananId}">
                </div>
            `);
            footer.insertAdjacentHTML('beforeend', `
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                <button wire:submit.prevent="deletePesanan" class="btn btn-danger">Ya, Hapus</button>
            `);
        });
    </script>
@endsection
