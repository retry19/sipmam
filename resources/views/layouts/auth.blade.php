<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login :: {{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <livewire:styles />
  <livewire:scripts />
</head>
<body>
  <div class="row align-items-center" style="min-height: 100vh">
    <div class="offset-md-4 col-md-4">
      @yield('content')
    </div>
  </div>
  
  <footer class="mx-auto mb-3 w-100 px-3 d-flex justify-content-between" style="position: absolute; bottom: 0;">
    <small class="text-muted">Built with ❤</small>
    <small class="text-muted">© 2020</small>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('js/adminlte.js') }}"></script>
  <script src="{{ asset('js/dashboard3.js') }}"></script>
  @yield('js')
</body>
</html>