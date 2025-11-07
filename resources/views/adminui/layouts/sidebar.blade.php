<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    @php
        // Force fresh query without cache
        \Illuminate\Support\Facades\DB::connection()->disableQueryLog();
        
        // Priority: Logo Admin first, fallback to Logo Website
        $logoAdmin = \App\Models\LogoAdmin::where('status', true)->orderBy('updated_at', 'desc')->first();
        
        // If no logo admin, use logo website (SYNC FEATURE)
        if (!$logoAdmin || !$logoAdmin->gambar) {
            $logoAdmin = \App\Models\LogoWebsite::where('status', true)->orderBy('updated_at', 'desc')->first();
        }
    @endphp
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('adminui.dashboard') }}">
        @if($logoAdmin && $logoAdmin->gambar)
            <img src="{{ asset('storage/' . $logoAdmin->gambar) }}?v={{ $logoAdmin->updated_at->timestamp }}&t={{ time() }}" class="navbar-brand-img h-100" alt="Admin Logo" style="max-height: 40px; object-fit: contain;">
        @else
            <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="...">
        @endif
        @if($logoAdmin && ($logoAdmin->nama_perusahaan || $logoAdmin->tagline))
            <div class="ms-3">
                @if($logoAdmin->nama_perusahaan)
                    <div class="font-weight-bold" style="line-height: 1.2;">
                        {{ $logoAdmin->nama_perusahaan }}
                    </div>
                @endif
                @if($logoAdmin->tagline)
                    <div class="text-xs opacity-8" style="line-height: 1.2;">
                        {{ $logoAdmin->tagline }}
                    </div>
                @endif
            </div>
        @endif
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
    @php $u = auth()->user(); @endphp
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/dashboard') ? 'active' : '') }}" href="{{ route('adminui.dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <title>shop </title>
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                  <g transform="translate(1716.000000, 291.000000)">
                    <g transform="translate(0.000000, 148.000000)">
                      <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                      <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
    <li class="nav-item mt-2">
    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Admin Panel</h6>
    </li>
  @if(!$u || $u->hasPermission('Profile'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/profile') ? 'active' : '') }} " href="{{ route('adminui.profile') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <title>customer-support</title>
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
              <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(1.000000, 0.000000)">
                  <path class="color-background" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z" opacity="0.59858631"></path>
                  <path class="color-foreground" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                  <path class="color-foreground" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Profile</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Users'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/users*') ? 'active' : '') }}" href="{{ route('adminui.users.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path class="color-background" d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 100-8 4 4 0 000 8z" fill="#FFFFFF"/>
        </svg>
      </div>
      <span class="nav-link-text ms-1">Users</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/home-hero*') ? 'active' : '') }}" href="{{ route('adminui.home-hero.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="fas fa-images text-primary text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Home Hero</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/header-info*') ? 'active' : '') }}" href="{{ route('adminui.header-info.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="fas fa-info-circle text-info text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Header Info</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/logo-website*') ? 'active' : '') }}" href="{{ route('adminui.logo-website.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="fas fa-globe text-success text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Logo Website</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/logo-admin*') ? 'active' : '') }}" href="{{ route('adminui.logo-admin.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="fas fa-shield-alt text-warning text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Logo Admin</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
  <li class="nav-item">
  <a class="nav-link {{ (Request::is('adminui/favicon*') ? 'active' : '') }}" href="{{ route('adminui.favicon.index') }}">
      <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="fa-solid fa-star text-info text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Favicon</span>
    </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('About Page'))
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#aboutSubmenu" class="nav-link {{ (Request::is('adminui/about*') ? '' : 'collapsed') }}" aria-controls="aboutSubmenu" role="button" aria-expanded="{{ (Request::is('adminui/about*') ? 'true' : 'false') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd" d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 7V9C15 9.55 14.55 10 14 10S13 9.55 13 9V7H11V9C11 9.55 10.45 10 10 10S9 9.55 9 9V7H3V9H3V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V9Z" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">About Page</span>
        </a>
        <div class="collapse {{ (Request::is('adminui/about*') ? 'show' : '') }}" id="aboutSubmenu">
            <ul class="nav ms-4 ps-3">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/about') && !Request::is('adminui/about/*') ? 'active' : '') }}" href="{{ route('adminui.about') }}">
                        <span class="sidenav-mini-icon"> H </span>
                        <span class="sidenav-normal"> Hero Section </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/about/content*') ? 'active' : '') }}" href="{{ route('adminui.about.content.index') }}">
                        <span class="sidenav-mini-icon"> C </span>
                        <span class="sidenav-normal"> About Content </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/about/testimonial*') ? 'active' : '') }}" href="{{ route('adminui.about.testimonial.index') }}">
                        <span class="sidenav-mini-icon"> T </span>
                        <span class="sidenav-normal"> Testimonials </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/about/headers*') ? 'active' : '') }}" href="{{ route('adminui.about.headers.index') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal"> Hero Page </span>
                    </a>
                </li>
            </ul>
        </div>
      </li>
      @endif
  @if(!$u || $u->hasPermission('Services'))
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#servicesSubmenu" class="nav-link {{ (Request::is('adminui/services*') ? '' : 'collapsed') }}" aria-controls="servicesSubmenu" role="button" aria-expanded="{{ (Request::is('adminui/services*') ? 'true' : 'false') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd" d="M3 4C3 3.44772 3.44772 3 4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4ZM5 5V19H19V5H5ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H14V17H7V15Z" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Services</span>
        </a>
        <div class="collapse {{ (Request::is('adminui/services*') ? 'show' : '') }}" id="servicesSubmenu">
            <ul class="nav ms-4 ps-3">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/services/header-layanan*') ? 'active' : '') }}" href="{{ route('adminui.services.header-layanan.index') }}">
                        <span class="sidenav-mini-icon"> H </span>
                        <span class="sidenav-normal"> Header Layanan </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/services/fitur-utama*') ? 'active' : '') }}" href="{{ route('adminui.services.fitur-utama.index') }}">
                        <span class="sidenav-mini-icon"> F </span>
                        <span class="sidenav-normal"> Fitur Utama </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/services/daftar-layanan*') ? 'active' : '') }}" href="{{ route('adminui.services.daftar-layanan.index') }}">
                        <span class="sidenav-mini-icon"> D </span>
                        <span class="sidenav-normal"> Daftar Layanan </span>
                    </a>
                </li>
            </ul>
        </div>
      </li>
  @endif
  @if(!$u || $u->hasPermission('Contact Page'))
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/contact') && !Request::is('adminui/contact-messages*') ? 'active' : '') }}" href="{{ route('adminui.contact') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd" d="M4 4C4 2.89543 4.89543 2 6 2H18C19.1046 2 20 4.89543 20 4V20C20 21.1046 19.1046 22 18 22H6C4.89543 22 4 21.1046 4 20V4ZM6 4V20H18V4H6ZM8 6H16V8H8V6ZM8 10H16V12H8V10ZM8 14H13V16H8V14Z" fill="#FFFFFF"/>
                    <circle cx="16" cy="18" r="2" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Contact Page</span>
        </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/footer*') ? 'active' : '') }}" href="{{ route('adminui.footer.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" d="M3 20H21V22H3V20ZM4 3H20C20.2652 3 20.5196 3.10536 20.7071 3.29289C20.8946 3.48043 21 3.73478 21 4V18C21 18.2652 20.8946 18.5196 20.7071 18.7071C20.5196 18.8946 20.2652 19 20 19H4C3.73478 19 3.48043 18.8946 3.29289 18.7071C3.10536 18.5196 3 18.2652 3 18V4C3 3.73478 3.10536 3.48043 3.29289 3.29289C3.48043 3.10536 3.73478 3 4 3ZM5 5V17H19V5H5Z" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Footer Settings</span>
        </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#requestQuoteSubmenu" class="nav-link {{ (Request::is('adminui/request-quote*') ? '' : 'collapsed') }}" aria-controls="requestQuoteSubmenu" role="button" aria-expanded="{{ (Request::is('adminui/request-quote*') ? 'true' : 'false') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M9 12H15M9 16H12" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Request Quote</span>
        </a>
        <div class="collapse {{ (Request::is('adminui/request-quote*') ? 'show' : '') }}" id="requestQuoteSubmenu">
            <ul class="nav ms-4 ps-3">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/request-quote') && !Request::is('adminui/request-quote/services*') && !Request::is('adminui/request-quote/inbox*') ? 'active' : '') }}" href="{{ route('adminui.request-quote.index') }}">
                        <span class="sidenav-mini-icon"> S </span>
                        <span class="sidenav-normal"> Settings </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/request-quote/inbox*') ? 'active' : '') }}" href="{{ route('adminui.request-quote.inbox.index') }}">
                        <span class="sidenav-mini-icon"> I </span>
                        <span class="sidenav-normal"> Inbox Messages </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/request-quote/services*') ? 'active' : '') }}" href="{{ route('adminui.request-quote.services.index') }}">
                        <span class="sidenav-mini-icon"> L </span>
                        <span class="sidenav-normal"> Service List </span>
                    </a>
                </li>
            </ul>
        </div>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Dashboard'))
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/contact-messages*') ? 'active' : '') }}" href="{{ route('adminui.contact-messages.index') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" d="M3 8L10.89 13.26C11.2187 13.4793 11.6049 13.5963 12 13.5963C12.3951 13.5963 12.7813 13.4793 13.11 13.26L21 8M5 19H19C19.5304 19 20.0391 18.7893 20.4142 18.4142C20.7893 18.0391 21 17.5304 21 17V7C21 6.46957 20.7893 5.96086 20.4142 5.58579C20.0391 5.21071 19.5304 5 19 5H5C4.46957 5 3.96086 5.21071 3.58579 5.58579C3.21071 5.96086 3 6.46957 3 7V17C3 17.5304 3.21071 18.0391 3.58579 18.4142C3.96086 18.7893 4.46957 19 5 19Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Contact Messages</span>
        </a>
  </li>
  @endif
  @if(!$u || $u->hasPermission('Projects'))
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#projectsSubmenu" class="nav-link {{ (Request::is('adminui/projects*') || Request::is('adminui/kategori-project*') ? '' : 'collapsed') }}" aria-controls="projectsSubmenu" role="button" aria-expanded="{{ (Request::is('adminui/projects*') || Request::is('adminui/kategori-project*') ? 'true' : 'false') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd" d="M3 3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V7C21 7.55228 20.5523 8 20 8H4C3.44772 8 3 7.55228 3 7V3ZM3 11C3 10.4477 3.44772 10 4 10H20C20.5523 10 21 10.4477 21 11V15C21 15.5523 20.5523 16 20 16H4C3.44772 16 3 15.5523 3 15V11ZM4 18C3.44772 18 3 18.4477 3 19V21C3 21.5523 3.44772 22 4 22H20C20.5523 22 21 21.5523 21 21V19C21 18.4477 20.5523 18 20 18H4Z" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Projects</span>
        </a>
        <div class="collapse {{ (Request::is('adminui/projects*') || Request::is('adminui/kategori-project*') ? 'show' : '') }}" id="projectsSubmenu">
            <ul class="nav ms-4 ps-3">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/projects') || Request::is('adminui/projects/create') || Request::is('adminui/projects/*/edit') ? 'active' : '') }}" href="{{ route('adminui.projects.index') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal"> Kelola Project </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/projects/header*') ? 'active' : '') }}" href="{{ route('adminui.projects.header.index') }}">
                        <span class="sidenav-mini-icon"> H </span>
                        <span class="sidenav-normal"> Header Projects </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/kategori-project*') ? 'active' : '') }}" href="{{ route('adminui.kategori-project.index') }}">
                        <span class="sidenav-mini-icon"> K </span>
                        <span class="sidenav-normal"> Kategori Project </span>
                    </a>
                </li>
            </ul>
        </div>
      </li>
      @endif
  @if(!$u || $u->hasPermission('Blog'))
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#blogSubmenu" class="nav-link {{ (Request::is('adminui/blog*') || Request::is('adminui/kategori') || Request::is('adminui/kategori/*') ? '' : 'collapsed') }}" aria-controls="blogSubmenu" role="button" aria-expanded="{{ (Request::is('adminui/blog*') || Request::is('adminui/kategori') || Request::is('adminui/kategori/*') ? 'true' : 'false') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd" d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3ZM5 5H19V19H5V5ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H14V17H7V15Z" fill="#FFFFFF"/>
                </svg>
            </div>
            <span class="nav-link-text ms-1">Blog</span>
        </a>
        <div class="collapse {{ (Request::is('adminui/blog*') || Request::is('adminui/kategori') || Request::is('adminui/kategori/*') ? 'show' : '') }}" id="blogSubmenu">
            <ul class="nav ms-4 ps-3">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/blog') || Request::is('adminui/blog/create') || Request::is('adminui/blog/*/edit') ? 'active' : '') }}" href="{{ route('adminui.blog.index') }}">
                        <span class="sidenav-mini-icon"> A </span>
                        <span class="sidenav-normal"> Artikel </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/blog/header*') ? 'active' : '') }}" href="{{ route('adminui.blog.header.index') }}">
                        <span class="sidenav-mini-icon"> H </span>
                        <span class="sidenav-normal"> Header Blog </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('adminui/kategori') || Request::is('adminui/kategori/*') ? 'active' : '') }}" href="{{ route('adminui.kategori.index') }}">
                        <span class="sidenav-mini-icon"> K </span>
                        <span class="sidenav-normal"> Kategori </span>
                    </a>
                </li>
            </ul>
        </div>
      </li>
      @endif
      @if(!$u || $u->hasPermission('Virtual Reality'))
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/virtual-reality') ? 'active' : '') }}" href="{{ route('adminui.virtual-reality') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <title>box-3d-50</title>
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                  <g transform="translate(1716.000000, 291.000000)">
                    <g transform="translate(603.000000, 0.000000)">
                      <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                      <path class="color-background opacity-6" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"></path>
                      <path class="color-background opacity-6" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <span class="nav-link-text ms-1">Virtual Reality</span>
        </a>
  </li>
  @endif
      @if(!$u || $u->hasPermission('RTL'))
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('adminui/rtl') ? 'active' : '') }}" href="{{ route('adminui.rtl') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <title>settings</title>
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                  <g transform="translate(1716.000000, 291.000000)">
                    <g transform="translate(304.000000, 151.000000)">
                      <polygon class="color-background opacity-6" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                      <path class="color-background opacity-6" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                      <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                    </g>
                  </g>
                </g>
              </g>
            </svg>
          </div>
          <span class="nav-link-text ms-1">RTL</span>
        </a>
  </li>
  @endif
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('adminui.logout') }}">
          @csrf
          <a href="#" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>spaceship</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(4.000000, 301.000000)">
                        <path class="color-background" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.18502508 38.0316667,0.18502508 C37.5584566,0.18502508 37.0972349,0.370464027 36.7633333,0.706666667 C36.4295,1.04286667 36.2445,1.50411667 36.2445,1.97733333 C36.2445,2.45055 36.4295,2.9118 36.7633333,3.248 C37.0972349,3.58419973 37.5584566,3.76964025 38.0316667,3.76964025 C38.5048767,3.76964025 38.9660984,3.58419973 39.3,3.248 C39.6337815,2.9118 39.8188333,2.45055 39.8188333,1.97733333 C39.8188333,1.50411667 39.6337815,1.04286667 39.3,0.706666667 Z M33.1066667,9.4 L26.424,16.0826667 L16.9293333,11.7166667 L16.9293333,16.0826667 L11.2293333,10.3826667 L5.53,16.0826667 L5.53,20.4486667 L16.9293333,31.8473333 L16.9293333,24.2666667 L26.424,19.9 L33.1066667,26.5826667 L37.4726667,21.216 L30.8,14.5433333 L37.4726667,7.87066667 L33.1066667,9.4 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </form>
      </li>
    </ul>
  </div>
</aside>