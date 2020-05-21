<div class="card">
    <div class="card-body">
        <h1>Login</h1>
        <p class="text-muted">Halo, selamat datang 😁</p>
        <br>
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        <form wire:submit.prevent="login">
            <div class="form-group">
                <input wire:model.debounce.500ms="username" type="text" class="form-control" placeholder="Masukan username anda">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input wire:model.debounce.500ms="password" type="password" class="form-control" placeholder="Masukan password anda">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-100 pt-3 text-right">
                <button type="submit" class="btn btn-primary px-4">Login</button>
            </div>
        </form>
    </div>
</div>
