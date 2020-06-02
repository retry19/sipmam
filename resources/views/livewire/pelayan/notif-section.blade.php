<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ count($notifications) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ count($notifications) }} Notifications</span>
        <div class="dropdown-divider"></div>
        @if (count($notifications) < 1)
            <p class="text-center my-3">Tidak ada notifikasi</p>
        @else
            @foreach ($notifications as $notif)
                @if($notif->aksi)
                    <a href="{{ route('notif.edit', $notif->id) }}" class="dropdown-item {{ !$notif->selesai ? 'notif-not-done' : '' }}">
                @else 
                    <a href="" class="dropdown-item {{ !$notif->selesai ? 'notif-not-done' : '' }}">
                @endif
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Pesanan (Meja: {{ $notif->pesanan->no_meja }})
                                <span class="float-right text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $notif->created_at->diffForHumans() }}</span>
                            </h3>
                            <p class="text-sm">{{ $notif->message }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
        <div class="dropdown-divider"></div>
        <a href="{{ route('notif.all') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>