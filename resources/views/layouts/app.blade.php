<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') :: Sipmam</title>

  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
  {{-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,500,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('css')

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}" async></script>
  <script src="{{ asset('js/adminlte.js') }}" async></script>

  <livewire:styles />
  <livewire:scripts />
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        @if (auth()->user()->role == 'pelayan' || auth()->user()->role == 'koki')
          <livewire:notification-icon :role="auth()->user()->role" />  
        @endif
        
        @if(auth()->user()->role == 'pelayan')
          <li class="nav-item">
            <livewire:pelayan.cart-icon />
          </li>
        @endif
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link elevation-4">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">SIPMAM</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>

            @if(auth()->user()->role == 'pelayan')
              <li class="nav-header">PELAYAN</li>
              <li class="nav-item">
                <a href="{{ route('pelayan.order') }}" class="nav-link @yield('order')">
                  <i class="nav-icon fas fa-shopping-bag"></i>
                  <p>Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pelayan.pesanan-all') }}" class="nav-link @yield('pesanan')">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Pesanan
                    @php
                      $jmlPesanan = App\Pesanan::whereDate('created_at', Carbon\Carbon::today())->count();
                    @endphp
                    <span class="badge badge-info right">{{ $jmlPesanan }}</span>
                  </p>
                </a>
              </li>
            @endif

            @if(auth()->user()->role == 'koki')
              <li class="nav-header">KOKI</li>
              <li class="nav-item">
                <a href="{{ route('koki.pesanan-all') }}" class="nav-link @yield('pesanan')">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Pesanan
                    @php
                      $jmlPesanan = App\Pesanan::whereDate('created_at', Carbon\Carbon::today())->count();
                    @endphp
                    <span class="badge badge-info right">{{ $jmlPesanan }}</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link @yield('menu')">
                  <i class="nav-icon fas fa-book"></i>
                  <p>
                    Menu
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('koki.menu-all') }}" class="nav-link @yield('menu-all')">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Menu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('koki.menu-add') }}" class="nav-link @yield('menu-add')">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tambah Menu</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif

            @if(auth()->user()->role == 'kasir')
              <li class="nav-header">KASIR</li>
              <li class="nav-item">
                <a href="{{ route('kasir.pesanan-all') }}" class="nav-link @yield('pesanan')">
                  <i class="nav-icon fas fa-calendar-alt"></i>
                  <p>
                    Pesanan
                    @php
                      $jmlPesanan = App\Pesanan::whereDate('created_at', Carbon\Carbon::today())->count();
                    @endphp
                    <span class="badge badge-info right">{{ $jmlPesanan }}</span>
                  </p>
                </a>
              </li>
            @endif

            <li class="nav-header">OPTION</li>

            @if (auth()->user()->role == 'pelayan' || auth()->user()->role == 'koki')
              <li class="nav-item">
                <a href="{{ route('notif.all') }}" class="nav-link @yield('notif')">
                  <i class="nav-icon fas fa-bell"></i>
                  <p>
                    Notifikasi
                    @php
                      $jmlNotif = App\Notification::whereDate('created_at', Carbon\Carbon::today())->where('role', auth()->user()->role)->count();
                    @endphp
                    <span class="badge badge-info right">{{ $jmlNotif }}</span>
                  </p>
                </a>
              </li>
            @endif

            <li class="nav-item">
              <livewire:auth.logout />
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">@yield('heading')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        @yield('content')
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <livewire:pelayan.cart-list />
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      Built with ❤
      <div class="float-right d-none d-sm-inline-block">
        © 2020 | SIPMAM
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  {{-- <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('js/adminlte.js') }}"></script> --}}

  <!-- OPTIONAL SCRIPTS -->
  {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/demo.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/dashboard3.js') }}"></script> --}}
  @yield('js')
</body>
</html>
