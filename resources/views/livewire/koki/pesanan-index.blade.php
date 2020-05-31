<div class="row">
    <div class="col-md-3">
        <div class="list-menu">
            @if (count($pesanan) < 1)
                <p>Tidak ada pesanan</p>
            @else
                <ul>
                    @foreach ($pesanan as $item)
                        <li 
                            wire:click="handleProsesPesanan({{ $item->id }})" 
                            class="{{ $item->status == 1 ? 'active' : '' }}"
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
                <livewire:koki.pesanan-item :pesananId="$p" />
            @endforeach
        </div>
    </div>

</div>

@section('title', 'Pesanan')
@section('pesanan', 'active')
@section('heading', 'Daftar Pesanan')
