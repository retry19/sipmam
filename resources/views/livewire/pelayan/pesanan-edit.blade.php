<div class="row">
    <div class="col-md-7">
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
                <h3 class="card-title">Daftar Pesanan</h3>
                <div class="card-tools">
                    <button type="button" wire:click="$emit('closePesananAdd')" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah</button>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pesananCount != 0)
                            @foreach ($listPesanan->detailPesanan as $detailPesanan)
                                @for ($i = 0; $i < $detailPesanan->jml_pesan; $i++)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $no++ }}</td>
                                        <td>{{ $detailPesanan->menu->nama_menu }}</td>
                                        <td class="text-center">{!! !$detailPesanan->menu->kosong ? 'Rp. '.$detailPesanan->menu->harga : '<strong class="text-danger">Kosong</strong>' !!}</td>
                                        <td class="text-center">
                                            <button type="button" data-target="#modalDeletePesanan{{ $no }}" class="btn btn-sm btn-danger" data-toggle="modal"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @php $totalHarga += $detailPesanan->menu->harga @endphp

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDeletePesanan{{ $no }}" tabindex="-1" role="dialog" aria-labelledby="modalDeletePesananLabel{{ $no }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDeletePesananLabel{{ $no }}">Detail Pesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus 1 pesanan :</p>
                                                        <p id="namaMenu" class="h5">{{ $detailPesanan->menu->nama_menu }}</p>
                                                    </div>
                                                    <div class="modal-footer" id="modal-footer">
                                                        <button wire:click.prevent="deletePesanan({{ $detailPesanan->id }})" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Ya, Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endforeach
                        @endif
                    </tbody>
                    {{-- <tbody>
                        @foreach ($listPesanan as $item)
                            @for ($i = 0; $i < $item['jml_pesan']; $i++)
                                <tr>
                                    <td scope="row" class="text-center">{{ $no++ }}</td>
                                    <td>{{ $item['nama_menu'] }}</td>
                                    <td class="text-center">{!! !$item['kosong'] ? 'Rp. '.$item['harga'] : '<strong class="text-danger">Kosong</strong>' !!}</td>
                                    <td class="text-center">
                                        <button type="button" data-target="#modalDeletePesanan{{ $no }}" class="btn btn-sm btn-danger" data-toggle="modal"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                                @php $totalHarga += $item['harga'] @endphp

                                <!-- Modal -->
                                <div class="modal fade" id="modalDeletePesanan{{ $no }}" tabindex="-1" role="dialog" aria-labelledby="modalDeletePesananLabel{{ $no }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDeletePesananLabel{{ $no }}">Detail Pesanan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form>
                                                <div class="modal-body">
                                                    <p>Apakah anda yakin akan menghapus 1 pesanan :</p>
                                                    <p id="namaMenu" class="h5">{{ $item['nama_menu'] }}</p>
                                                </div>
                                                <div class="modal-footer" id="modal-footer">
                                                    <button wire:click.prevent="deletePesanan({{ $item['id'] }})" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Ya, Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
            <div class="card-footer text-right">
                <h4>Total Harga : <span class="badge badge-info">Rp. {{ $totalHarga }}<span></h4>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <livewire:pelayan.pesanan-add :isShow="$showPesananAdd" />
    </div>

</div>

@section('title', 'Edit Pesanan')
@section('pesanan', 'active')
@section('heading')
    <a href="{{ route('pelayan.pesanan-all') }}" class="btn btn-secondary p text-white"><i class="fas fa-angle-left"></i>&nbsp; Kembali</a> &nbsp; Edit Pesanan
@endsection
