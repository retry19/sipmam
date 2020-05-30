<div class="card shadow-none" style="display: {{ $display >= 1 ? 'block' : 'none' }}">
    <div class="card-header">
        <h3 class="card-title">Tambah Pesanan</h3>
        <div class="card-tools">
            <button type="button" wire:click="$emit('closePesananAdd')" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                @foreach ($menus as $menu)
                    <tr>
                        <td scope="row" class="text-center">{{ $no++ }}</td>
                        <td>{{ $menu['nama_menu'] }}</td>
                        <td>Rp. {{ $menu['harga'] }}</td>
                        <td class="text-center">
                            @if ($menu['jml_tersedia'] > $menu['jml_dipesan'])
                                <button type="button" wire:click="$emit('addPesanan', {{ $menu['id'] }})" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></a>
                            @else
                                <p class="text-danger">Kosong</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $menus->links() }}
    </div>
</div>