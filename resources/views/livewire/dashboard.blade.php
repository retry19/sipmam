<div class="container">
    @switch(auth()->user()->role)
        @case('owner')
            <livewire:owner.dashboard />      
            @break
        @case('pelayan')
            <livewire:pelayan.dashboard />      
            @break
        @case('koki')
            <livewire:koki.dashboard />      
            @break
        @case('kasir')
            <livewire:kasir.dashboard />      
            @break
        @default
    @endswitch
</div>

@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('heading', 'Dashboard')
