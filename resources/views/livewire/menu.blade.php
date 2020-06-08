<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-5">
        <div class="container">
            <a class="navbar-brand" href="/"><b>SIPMAM</b> 2020</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-0 ml-auto">
                    <a class="nav-item nav-link" href="{{ url('/') }}">Home</a>
                    <a class="nav-item nav-link" href="{{ url('/menu') }}">Menu</a>
                    <a class="nav-item nav-link" href="{{ url('/#rating') }}">Rating</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <section class="main row align-items-center">
            <div class="col-md-6">
                <h1>Daftar Menu</h1>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/photo-main.png') }}" alt="foto-makanan-from-unsplash" class="img-fluid float-right">
            </div>
        </section>

        <section class="favorit">
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4">
                        <div class="card shadow">
                            <img src="{{ asset($menu->fotoMenuPath) }}" class="card-img-top" alt="{{ $menu->nama_menu }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                                <br>
                                <footer>{{ $this->hargaFormat($menu->harga) }}</footer>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>
</div>

@section('title', 'Menu')
