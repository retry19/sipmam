<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-5 p-3">
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
                <h1>Temukan Menu Favoritmu</h1>
                <a href="{{ url('/menu') }}" class="btn btn-warning">Cari menu</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/photo-main.png') }}" alt="foto-makanan-from-unsplash" class="img-fluid float-right">
            </div>
        </section>

        <section class="rating" id="rating">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Rating</h4>
                    <p>Penilaian pelanggan dalam kualitas kepuasan dari menu yang disajikan<br>dan proses pelayanan.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <h5>Menu</h5>
                    <span>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
                <div class="col-md-6 text-center">
                    <h5 class="rating-pelayan">Pelayanan</h5>
                    <span>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star active"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
            </div>
        </section>

        <section class="favorit">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Menu</h4>
                    <p>Daftar menu favorit</p>
                </div>
            </div>
            <div class="row">
                @if ($favoriteMenus->isEmpty())
                    <p>Belum ada menu favorit ❤</p>
                @endif
                @foreach ($favoriteMenus as $item)
                    <div class="col-md-4 col-6">
                        <div class="card shadow">
                            <img src="{{ asset($item->menu->fotoMenuPath) }}" class="card-img-top" alt="{{ $item->menu->nama_menu }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->menu->nama_menu }}</h5>
                                <br>
                                <footer>{{ $this->hargaFormat($item->menu->harga) }}</footer>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="ask">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>Apakah menu favoritmu tidak ada diatas?</h4>
                    <p>Temukan menu favoritmu</p>
                    <a href="{{ url('/menu') }}" class="btn btn-warning">Cari menu</a>
                </div>
            </div>
        </section>
    </div>
</div>

@section('title', 'Home')
