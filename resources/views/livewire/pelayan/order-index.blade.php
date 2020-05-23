<div class="row">
    <div class="col-md-3">
        <div class="list-menu">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text search-icon" id="search"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control search-field" placeholder="Cari menu..." aria-label="Cari menu..." aria-describedby="search">
                </div>
            </form>
            <ul>
                <li class="active">
                    Semua
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li>
                    Makanan
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li>
                    Minuman
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "percentPosition": true}'>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 1</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-2.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 2</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-3.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 3</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/minuman-1.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 4</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/minuman-2.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 5</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/minuman-3.jpeg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 6</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 7</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 8</h5>
                        <br>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('heading', 'Daftar Menu')
