<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b>SIPMAM</b>2020</a>
    </div>
    <div class="card shadow">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Administrator</p>

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif

            <form wire:submit.prevent="login">
                <div class="mb-3">
                    <div class="input-group">
                        <input wire:model.debounce.500ms="username" wire:loading.attr="readonly" wire:target="login" type="text" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input wire:model.debounce.500ms="password" wire:loading.attr="readonly" wire:target="login" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="offset-md-8 col-md-4">
                        <button type="submit" wire:target="login" wire:loading.class="disabled" class="btn btn-primary btn-block">
                            <span wire:loading wire:target="login" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span wire:loading.remove wire:target="login">Masuk</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
