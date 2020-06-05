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
                        <tr>
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
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->no_meja }}</td>
                                <td>{{ $p->total_harga }}</td>
                                <td>{{ $this->status($p->status) }}</td>
                                <td></td>
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

@section('title', 'List Pesanan')
@section('pesanan', 'active')
@section('heading', 'List Pesanan')
