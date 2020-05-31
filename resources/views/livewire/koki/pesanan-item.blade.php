<div class="card shadow-none">
    <div class="card-header">
        <h3 class="card-title">Meja {{ $pesanan->no_meja }}</h3>
        <div class="float-right btn-group">
            <button type="button" class="btn btn-warning btn-sm">Selesai</button>
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Terdapat Stok Kosong</a>
            </div>
        </div>
    </div>
    <div class="card-body py-3 px-0">
        <ul class="list-group list-group-flush">
            @foreach ($pesanan->detailPesanan as $detail)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $detail->menu->nama_menu }}
                    <span class="badge badge-info badge-pill">{{ $detail->jml_pesan }}</span>
                </li>
            @endforeach
        </ul>
        <p class="card-text mt-3 px-4 text-right"><small class="text-muted">{{ $pesanan->created_at->diffForHumans() }}</small></p>
    </div>
</div>