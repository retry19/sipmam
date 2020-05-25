<div class="cart-list">
    <h4>Daftar Pesanan</h4>
    <ul>
        @foreach ($cartDetail as $item)
            <li class="card">
                <div class="card-body">
                    <img src="" alt="">
                    <div>
                        <p>{{ $item['nama_menu'] }}</p>
                        <p>{{ $item['harga'] }}</p>
                        <div>
                            <button>-</button>
                            <span>0</span>
                            <button>+</button>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
