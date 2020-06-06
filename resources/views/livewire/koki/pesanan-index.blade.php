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
            @if (count($pesanan) < 1)
                <p>Tidak ada pesanan</p>
            @else
                <ul>
                    @foreach ($pesanan as $item)
                        <li 
                            wire:click="handleProsesPesanan({{ $item->id }})" 
                            class="{{ $this->generateClass($item->status) }}"
                        >
                            Meja : {{ $item->no_meja }} 
                            <small class="text-muted">
                                {{ $item->status < 2 ? $item->created_at->diffForHumans() : 'Selesai' }}
                            </small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="col-md-9 list-pesanan">
        <div class="card-columns">
            @foreach ($listProsesPesanan as $p)
                <div class="card shadow-none">
                    <div class="card-header">
                        <h3 class="card-title">Meja {{ $p->no_meja }}</h3>
                        <div class="float-right btn-group">
                            <button wire:click="handleProsesSelesai({{ $p->id }})" type="button" wire:target="handleProsesSelesai" wire:loading.class="disabled" class="btn btn-warning btn-sm" {{ $this->checkMenuKosong($p->detailPesanan) ? 'disabled' : '' }}>
                                <span wire:loading wire:target="handleProsesSelesai" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                <span wire:loading.remove wire:target="handleProsesSelesai">Selesai</span>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('koki.pesanan-edit', $p->id) }}">Terdapat Stok Kosong</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-3 px-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($p->detailPesanan as $detail)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $detail->menu->nama_menu }}
                                    @if ($detail->menu->kosong || $detail->menu->jml_tersedia == $detail->menu->jml_dipesan)
                                        <span class="badge badge-danger badge-pill">Kosong!</span>
                                    @else
                                        <span class="badge badge-info badge-pill">{{ $detail->jml_pesan }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <p class="card-text mt-3 px-4 text-right"><small class="text-muted">{{ $p->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@section('title', 'Pesanan')
@section('pesanan', 'active')
@section('heading', 'Daftar Pesanan')
