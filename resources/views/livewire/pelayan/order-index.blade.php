<div class="row">
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
    <div class="col-md-9">
        <div class="grid" id="grid">
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
        {{ $menus->links() }}
    </div>
</div>

@section('title', 'Order')
@section('order', 'active')
@section('heading', 'Daftar Menu')
@section('js')
    <script>
        let elmn = document.getElementById('grid');
        if (elmn != null) {
            let options = {
                "itemSelector": ".grid-item",
                "percentPosition": true
            };

            let msnry = new Masonry('.grid', options);
            
            setInterval(() => {
                msnry = new Masonry('.grid', options);
            }, 200);
        }
    </script>
@endsection
