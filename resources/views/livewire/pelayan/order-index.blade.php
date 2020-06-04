<div class="row">
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
    <div class="col-md-3">
        <div class="list-menu">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text search-icon" id="search"><i class="fas fa-search"></i></span>
                    </div>
                    <input wire:model.debounce.500ms="menuSearch" type="text" class="form-control search-field" placeholder="Cari menu..." aria-label="Cari menu..." aria-describedby="search">
                </div>
            </form>
            <ul>
                <li wire:click="handleCategorySelected(null)" 
                    class="{{ $categorySelected == null ? 'active' : '' }}">
                    Semua
                </li>
                <li wire:click="handleCategorySelected('makanan')" 
                    class="{{ $categorySelected == 'makanan' ? 'active' : '' }}">
                    Makanan
                </li>
                <li wire:click="handleCategorySelected('minuman')" 
                    class="{{ $categorySelected == 'minuman' ? 'active' : '' }}">
                    Minuman
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 list-order">
        <div wire:loading.class="loading" class="card-columns">
            @foreach ($menus as $menu)
                @if ($menu->kosong || $menu->jml_tersedia <= $menu->jml_dipesan)
                    <div class="card disabled">
                @else
                    <div wire:click="$emit('menuSelected', {{ $menu->id }})" 
                        class="card {{ in_array($menu->id, $cart) ? 'active' : '' }}">
                @endif
                    <img src="{{ asset('img/foods/'.$menu->foto_menu) }}" class="card-img-top" alt="{{ $menu->nama_menu }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                        <br>
                        <footer>Rp. {{ $menu->harga }}</footer>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $menus->links() }}
    </div>
</div>

@section('title', 'Order')
@section('order', 'active')
@section('heading', 'Daftar Menu')

{{-- @section('js')
    <script>
        Echo.channel('koki')
            .listen('MenuEmpty', (e) => {
                console.log("haha");
            });
    </script>
@endsection --}}
