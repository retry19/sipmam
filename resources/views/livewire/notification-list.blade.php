<div class="row">
    <div class="col-md-12">
        <div class="card shadow-none">
            <div class="card-header">
                <h3 class="card-title">Daftar Notifikasi</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">No. Meja</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($notifications) < 1)
                            <tr>
                                <td scope="row" colspan="6" class="text-center">
                                Tidak ada notifikasi hari ini...
                                </td>
                            </tr>
                        @endif
                        @foreach ($notifications as $notif)
                            <tr class="text-center">
                                <td scope="row">{{ $no++ }}</td>
                                <td>{{ $notif->pesanan->no_meja }}</td>
                                <td>{{ $notif->message }}</td>
                                <td>
                                    @if ($notif->selesai == 0)
                                        <span class="badge badge-danger">{{ $notif->aksi ? 'Belum selesai' : 'Belum dibaca' }}
                                    @else
                                        <span class="badge badge-success">Selesai
                                    @endif
                                    </span>
                                </td>
                                <td>{{ $notif->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($notif->aksi)
                                        <a href="{{ route('notif.edit', $notif->id) }}" class="btn btn-sm btn-warning {{ $notif->selesai ? 'disabled' : '' }}">
                                    @else
                                        <a href="" class="btn btn-sm btn-warning {{ $notif->selesai ? 'disabled' : '' }}">
                                    @endif
                                        <i class="fas {{ $notif->aksi ? 'fa-edit' : 'fa-check' }}"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>

@section('title', 'Notifikasi')
@section('notif', 'active')
@section('heading', 'Daftar Notifikasi')
