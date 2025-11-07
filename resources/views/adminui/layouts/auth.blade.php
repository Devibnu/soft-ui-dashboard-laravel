<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  @php
    $activeFavicon = \App\Models\FaviconWebsite::where('status', 1)->first();
    $activeLogo = \App\Models\LogoWebsite::where('status', 1)->first();
  @endphp
  @if($activeFavicon && $activeFavicon->favicon)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $activeFavicon->favicon) }}?v={{ $activeFavicon->updated_at->timestamp }}">
  @elseif($activeLogo && $activeLogo->gambar)
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $activeLogo->gambar) }}?v={{ $activeLogo->updated_at->timestamp }}">
  @else
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  @endif
  <title>
    {{ config('app.name', 'Jasa Ibnu') }} - Admin Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Submenu active state - matching Blog submenu style */
    .navbar-vertical .navbar-nav .nav .nav-item .nav-link.active {
      background-color: transparent;
      font-weight: 600;
    }
    .navbar-vertical .navbar-nav .nav .nav-item .nav-link.active .sidenav-mini-icon,
    .navbar-vertical .navbar-nav .nav .nav-item .nav-link.active .sidenav-normal {
      color: #344767;
      font-weight: 600;
    }
  </style>
  @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100 {{ (\Request::is('adminui/rtl') ? 'rtl' : (Request::is('adminui/virtual-reality') ? 'virtual-reality' : '')) }}">
  
  <!-- Success/Error Notifications -->
  @if (session('success'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: "{{ session('success') }}",
          confirmButtonColor: '#3085d6',
          timer: 3000,
          showConfirmButton: false
      });
  });
  </script>
  @endif

  @if (session('error'))
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
          icon: 'error',
          title: 'Terjadi Kesalahan!',
          text: "{{ session('error') }}",
          confirmButtonColor: '#d33'
      });
  });
  </script>
  @endif
  
  @if (\Request::is('adminui/rtl'))  
    @include('adminui.layouts.sidebar-rtl')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
      @include('adminui.layouts.nav-rtl')
      <div class="container-fluid py-4">
        @yield('content')
        @include('adminui.layouts.footer')
      </div>
    </main>

  @elseif (\Request::is('adminui/profile'))  
    @include('adminui.layouts.sidebar')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
      @include('adminui.layouts.nav')
      @yield('content')
    </div>

  @elseif (\Request::is('adminui/virtual-reality')) 
    @include('adminui.layouts.nav')
    <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('{{ asset('assets/img/vr-bg.jpg') }}') ; background-size: cover;">
      @include('adminui.layouts.sidebar')
      <main class="main-content mt-1 border-radius-lg">
        @yield('content')
      </main>
    </div>
    @include('adminui.layouts.footer')

  @else
    @include('adminui.layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('adminui/rtl') ? 'overflow-hidden' : '') }}">
      @include('adminui.layouts.nav')
      <div class="container-fluid py-4">
        @yield('content')
        @include('adminui.layouts.footer')
      </div>
    </main>
  @endif

  @include('adminui.layouts.fixed-plugin')
  @include('adminui.layouts.scripts')
  @stack('scripts')
</body>

</html>