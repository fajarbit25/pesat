<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    {{$title}}
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.0.0')}}" rel="stylesheet" />
  @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-200">

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/" target="_blank">
        <img src="{{asset('storage/logo/'.session('store')->logo)}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"> {{session('store')->storename}} </span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('dashboard*') ? 'active' : '' }} " href="{{route('dashboard')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @if(Auth::user()->level == '1')
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('medicine*') ? 'active' : '' }} " href="{{route('medicine')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons">inventory_2</i>
            </div>
            <span class="nav-link-text ms-1">Master Produk</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->is('egg*') ? 'active' : '' }} " href="{{route('egg')}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                 <i class="material-icons opacity-10">egg</i>
                </div>
                <span class="nav-link-text ms-1">Stock Telur</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('report-egg*') ? 'active' : '' }} " href="{{route('egg.laporanTelurMasuk')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
               <i class="material-icons opacity-10">egg</i>
              </div>
              <span class="nav-link-text ms-1">Laporan Telur Masuk</span>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('transaksi*') ? 'active' : '' }}" href="{{route('transaksi')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">add_shopping_cart</i>
              </div>
              <span class="nav-link-text ms-1">Barang Keluar</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('inbound*') ? 'active' : '' }}" href="{{route('inbound')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">system_update_alt</i>
              </div>
              <span class="nav-link-text ms-1">Barang Masuk</span>
          </a>
        </li>   

        <hr class="light horizontal my-0">

        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('debt*') ? 'active' : '' }}" href="{{route('debt')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">payment</i>
              </div>
              <span class="nav-link-text ms-1">Hutang Supplier</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->is('hutang*') ? 'active' : '' }}" href="{{route('hutang')}}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">payment</i>
                </div>
                <span class="nav-link-text ms-1">Piutang Costumer</span>
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('buyer*') ? 'active' : '' }}" href="{{route('hutang.buyer')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">shopping_cart_checkout</i>
              </div>
              <span class="nav-link-text ms-1">Penjualan Telur</span>
          </a>
      </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('upah*') ? 'active' : '' }}" href="{{route('upahBuruh')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">engineering</i>
              </div>
              <span class="nav-link-text ms-1">Upah Buruh</span>
          </a>
        </li>

        <hr class="light horizontal my-0">
        @if(Auth::user()->level == '1')
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('user*') ? 'active' : '' }}" href="{{route('user')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Personal</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('store*') ? 'active' : '' }}" href="{{route('user.store')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">storefront</i>
              </div>
              <span class="nav-link-text ms-1">Toko</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <form method="POST" action="/logout">
        @csrf
      <div class="mx-3">
        <button type="submit" class="btn bg-gradient-primary mt-4 w-100" type="button">Logout</button>
      </div>
      </form>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{$page}}</li>
          </ol>
          {{session('store')->slogan}}
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <a href="{{route('user.password')}}">
            <span class="fw-bold text-success"> {{Auth::user()->name}} </span>
            </a>
          </div>
          
        </div>
      </div>
    </nav>
    <!-- End Navbar -->


    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row min-vh-80 h-100">
        <div class="col-12">
          @yield('content')
        </div>
    </div>

    <footer class="footer pt-5">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://purnamasinargemilang.co.id" class="font-weight-bold" target="_blank">PSG</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://https://purnamasinargemilang.co.id/#service" class="nav-link text-muted" target="_blank">Our Service</a>
              </li>
              <li class="nav-item">
                <a href="https://https://purnamasinargemilang.co.id/#about" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="/developers" class="nav-link text-muted" target="_blank">Developer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

  </div>


  </main>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">widgets</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <div class="mt-3">
          <h6 class="mb-0">Menu</h6>
        </div>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('dashboard*') ? 'active' : '' }} " href="{{route('dashboard')}}"> Dashboard </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('medicine*') ? 'active' : '' }} " href="{{route('medicine')}}"> Master Produk </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('egg*') ? 'active' : '' }} " href="{{route('egg')}}"> Stock Telur </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('transaksi*') ? 'active' : '' }}" href="{{route('transaksi')}}"> Barang Keluar </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('inbound*') ? 'active' : '' }}" href="{{route('inbound')}}"> Barang Masuk </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('debt*') ? 'active' : '' }}" href="{{route('debt')}}"> Hutang Supplier </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('hutang*') ? 'active' : '' }}" href="{{route('hutang')}}"> Piutang Costumer </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('buyer*') ? 'active' : '' }}" href="{{route('hutang.buyer')}}"> Penjualan Telur </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('upah*') ? 'active' : '' }}" href="{{route('upahBuruh')}}"> Upah Buruh </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('user*') ? 'active' : '' }}" href="{{route('user')}}"> Personal </a>
        <a class="btn bg-gradient-dark px-3 mb-2 {{ request()->is('store*') ? 'active' : '' }}" href="{{route('user.store')}}"> Toko </a>
        <form method="POST" action="/logout">
          @csrf
        <div class="mx-3">
          <button type="submit" class="btn bg-gradient-primary mt-4 w-100" type="button">Logout</button>
        </div>
        </form>

        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">

      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/material-dashboard.min.js?v=3.0.1')}}"></script>
  <script src="{{asset('assets/js/jquery.js')}}"></script>
  <script src="{{asset('assets/js/sweat-alert.js')}}"></script>
  @livewireScripts
  @stack('scripts')

</body>

</html>