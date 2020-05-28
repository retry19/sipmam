<div class="cart-list">
    <h4 class="mb-4">Daftar Pesanan</h4>
    @if (count($cartDetail) <= 0)
        <p>Tidak ada pesanan 🌝</p>
    @else
        @php $totalHarga = 0; @endphp
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
                @php $totalHarga += ($item['harga'] * $item['qty']) @endphp
            @endforeach
        </ul>
        <div class="form-group">
            <input wire:model="noMeja" type="number" class="form-control" min="1" placeholder="No. Meja">
            <small class="text-danger">{{ $validNoMeja > 0 ? 'Meja sudah terisi' : '' }}</small>
        </div>
        <div class="cart-harga mb-4">
            <p>Total Harga :</p>
            <h4>Rp. {{ $totalHarga }}</h4>
        </div>
        <button wire:click="$emit('submitOrder', {{ $totalHarga }})" class="btn btn-primary w-100 mb-2 <?php if($noMeja == null || $validNoMeja != 0) { echo 'btn-disabled'; } else { echo ''; } ?>">Order</button>
        <button wire:click="$emit('cancelOrder')" class="btn btn-outline-secondary w-100 text-white">Batal</button>
    @endif
</div>
