<div class="row">
    <div class="col-md-12">
        {{ $hashids }}
        <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "percentPosition": true}'>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 1</h5>
                        <p class="card-text">This is a longer</p>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
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
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 3</h5>
                        <p class="card-text">This is a longer card</p>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 4</h5>
                        <p class="card-text">This is a longer card</p>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 5</h5>
                        <p class="card-text">This is a longer card</p>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title that 6</h5>
                        <p class="card-text">This is a longer card with supporting</p>
                        <footer>
                            Rp. 300.000
                        </footer>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 7</h5>
                        <p class="card-text">This is a longer card</p>
                    </div>
                </div>
            </div>
            <div class="grid-item">
                <div class="card">
                    <img src="{{ asset('img/foods/makanan-1.jpg') }}" class="card-img-top rounded" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 8</h5>
                        <p class="card-text">This is a longer</p>
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
@section('css')
    <style>
        .grid-item {
            padding-bottom: 10px;
            width: 50%;
        }
        .grid-item:nth-of-type(odd) {
            padding-left: 10px;
        }
        .grid-item:nth-of-type(even) {
            padding-right: 10px;
        }
        .grid-item:nth-child(1) {
            padding-left: 0;
            padding-right: 10px;
        }
        .grid-item:nth-child(2) {
            padding-right: 0;
            padding-left: 10px;
        }

        @media (min-width: 575px) {
            .grid-item:nth-of-type(odd) {
                padding-left: 10px;
                padding-bottom: 10px;
                width: 50%;
            }
            .grid-item:nth-of-type(even) {
                padding-right: 10px;
                padding-bottom: 10px;
                width: 50%;
            }
            .grid-item:nth-child(1) {
                padding-left: 0;
                padding-right: 10px;
                padding-bottom: 10px;
                width: 50%;
            }
            .grid-item:nth-child(2) {
                padding-right: 0;
                padding-left: 10px;
                padding-bottom: 10px;
                width: 50%;
            }
        }

    </style>
@endsection
