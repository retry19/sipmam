<div class="row">
    <div class="col-md-3">
        <div class="list-menu">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text search-icon" id="search"><i class="fas fa-search"></i></span>
                    </div>
                    <input wire:model.debounce.500ms="mejaSearch" type="text" class="form-control search-field" placeholder="Cari meja..." aria-label="Cari meja..." aria-describedby="search">
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
            <table class="table table-bordered">
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
                                <button class="btn btn-sm btn-secondary">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pesanan->links() }}
        </div>
        {{-- <div class="grid" id="grid">
            @foreach ($menus as $menu)
                <div wire:click="$emit('menuSelected', {{ $menu->id }})" class="grid-item">
                    <div class="card {{ in_array($menu->id, $cart) ? 'active' : '' }}">
                        <img src="{{ asset('img/foods/'.$menu->foto_menu) }}" class="card-img-top" alt="{{ $menu->nama_menu }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <br>
                            <footer>Rp. {{ $menu->harga }}</footer>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $menus->links() }} --}}
    </div>
</div>

@section('title', 'Pesanan')
@section('pesanan', 'active')
@section('heading', 'Daftar Pesanan')
