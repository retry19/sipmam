<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login :: {{ config('app.name') }}</title>
  
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,500,700" rel="stylesheet">
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
  <div class="row align-items-center" style="min-height: 100vh">
    <div class="offset-md-4 col-md-4">
      @yield('content')
    </div>
  </div>
  
  <footer class="mx-auto mb-3 w-100 px-3 d-flex justify-content-between" style="position: absolute; bottom: 0;">
    <small class="text-muted">Built with ❤</small>
    <small class="text-muted">© 2020</small>
  </footer>

  @yield('js')
</body>
</html>