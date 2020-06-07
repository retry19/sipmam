<div class="row">
    <div class="col-md-12">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Pesanan</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Pelayan</th>
                            <th>No. Meja</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $p)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->no_meja }}</td>
                                <td>{{ $p->totalHargaFormat }}</td>
                                <td>
                                    @if ($p->status <= 1)
                                        <span class="badge badge-info">{{ $this->status($p->status) }}</span>
                                    @else
                                        <span class="badge badge-success">{{ $this->status($p->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($p->status == 2)
                                        <a href="{{ route('kasir.pesanan-pay', $p->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-wallet"></i>&nbsp; Bayar
                                        </a>
                                    @else
                                        <a wire:click="printInvoice({{ $p->id }})" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-download"></i>&nbsp; Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $pesanan->links() }}
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        window.livewire.on('notifSound', () => {
            let sound = new Audio('http://localhost:8000/audio/juntos.ogg');
            
            sound.play();
        });
    </script>
@endsection

@section('title', 'List Pesanan')
@section('pesanan', 'active')
@section('heading', 'List Pesanan')
