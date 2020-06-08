<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') :: {{ config('app.name') }}</title>
  
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,500,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('css')

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}" async></script>
  <script src="{{ asset('js/adminlte.js') }}" async></script>

  <livewire:styles />
  <livewire:scripts />
</head>
<body>
  @yield('content')
  
  <footer class="container">
    <div class="row">
      <div class="col-md-5">
        <h5><b>SIPMAM</b> 2020</h5>
      </div>
      <div class="col-md-4">
        <h5><b>Tentang kami</b></h5>
        <p class="text-muted mb-5">Kedai makanan yang menyediakan<br>
          berbagai menu makanan.</p>
        <h5><b>Kontak</b></h5>
        <p class="text-muted mb-5">hubungi@sipmam.com</p>
      </div>
      <div class="col-md-3">
        <h5><b>Lokasi</b></h5>
        <p class="text-muted mb-5">Jl. Dewi Sartika, Kuningan, <br>
          Kec. Kuningan, Kab. Kuningan, <br>
          Jawa Barat <br>
          45511</p>
        <p class="text-muted mb-5">Built with ❤</p>
      </div>
    </div>
  </footer>

  @yield('js')
</body>
</html>