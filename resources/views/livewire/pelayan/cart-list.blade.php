<div class="cart-list">
    <h4 class="mb-4">Daftar Pesanan</h4>
    <ul>
        @foreach ($cartDetail as $item)
            <li class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $item['nama_menu'] }}</h5>
                    <p class="card-text">Rp. {{ $item['harga'] }}</p>
                    <div class="d-flex w-100 justify-content-between mt-2">
                        <span>
                            <button wire:click="minusItem({{ $item['id'] }})" class="btn btn-info btn-sm">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                            <span class="qty mx-2">{{ $item['qty'] }}</span>
                            <button wire:click="plusItem({{ $item['id'] }})" class="btn btn-info btn-sm">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </span>
                        <button wire:click="$emit('removeItemCart', {{ $item['id'] }})" class="btn btn-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
