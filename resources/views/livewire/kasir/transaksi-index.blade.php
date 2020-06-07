<div class="row">
    <div class="col-md-12">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Transaksi</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Total Bayar</th>
                            <th>Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $t)
                            <tr class="text-center">
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->total_bayar }}</td>
                                <td>{{ $t->kembali }}</td>
                                <td>
                                    @if ($t->status < 1)
                                        <span class="badge badge-info">Belum Bayar</span>
                                    @else
                                        <span class="badge badge-success">Sudah Bayar</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
</div>

@section('title', 'Daftar Transaksi')
@section('transaksi', 'active')
@section('heading', 'Daftar Transaksi')
