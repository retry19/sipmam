<div class="row">
    <div class="col-md-12">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Daftar Menu</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center table-sm">
                            <th rowspan="2">#</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Foto</th>
                            <th rowspan="2">Jenis</th>
                            <th colspan="2">Jumlah</th>
                            <th rowspan="2">Harga</th>
                            <th rowspan="2">Kosong</th>
                            <th rowspan="2">Opsi</th>
                        </tr>
                        <tr class="text-center table-sm">
                            <th>Tersedia</th>
                            <th>Dipesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($menus) < 1)
                            <tr>
                                <td scope="row" colspan="9" class="text-center">
                                Tidak ada menu...
                                </td>
                            </tr>
                        @endif
                        
                        @foreach ($menus as $menu)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td class="text-left">{{ $menu->nama_menu }}</td>
                                <td class="text-left">
                                    <img src="{{ asset('img/foods/'.$menu->foto_menu) }}" alt="{{ $menu->foto_menu }}" class="img-fluid" width="60">
                                </td>
                                <td>{{ $menu->jenis_menu }}</td>
                                <td>{{ $menu->jml_tersedia }}</td>
                                <td>{{ $menu->jml_dipesan }}</td>
                                <td>Rp. {{ $menu->harga }}</td>
                                <td>
                                    {!! $menu->kosong || $menu->jml_tersedia <= $menu->jml_dipesan ? '<i class="fas fa-check"></i>' : '' !!}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button> &nbsp;
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan menghapus menu "{{ $menu->nama_menu }}"
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                                        <button wire:click="deleteMenu({{ $menu->id }})" type="button" class="btn btn-primary">Ya, yakin</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
</div>

@section('title', 'Menu')
@section('menu', 'active')
@section('heading', 'Menu')
