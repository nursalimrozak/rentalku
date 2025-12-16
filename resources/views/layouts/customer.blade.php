<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ $appSettings['meta_title'] ?? $appSettings['app_name'] ?? 'RentalKu' }} - User Dashboard</title>

    <!-- Favicon -->
    @if(isset($appSettings['app_favicon']))
        <link rel="shortcut icon" href="{{ asset('storage/' . $appSettings['app_favicon']) }}">
    @else
        <link rel="shortcut icon" href="{{ asset('customer_assets/images/favicon.png') }}">
    @endif
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('customer_assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('customer_assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer_assets/css/all.min.css') }}">       

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('customer_assets/css/select2.min.css') }}">
    
    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('customer_assets/css/feather.css') }}">
        
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('customer_assets/css/style.css') }}">
    
    @stack('styles')
    <style>
        .app-logo {
            max-width: 180px;
            height: auto;
        }
        @media (max-width: 768px) {
            .app-logo {
                max-width: 120px;
            }
        }
        .header.header-four {
            background-color: #121212 !important;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .main-wrapper {
            padding-top: 79px;
        }
    </style>
</head>
<body>
    
    <div class="main-wrapper">
    
        <!-- Header -->
        <header class="header header-four">
            <div class="container">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="{{ route('home') }}" class="navbar-brand logo">
                            @if(isset($appSettings['app_logo_white']))
                                <img src="{{ asset('storage/' . $appSettings['app_logo_white']) }}" class="img-fluid white-logo app-logo" alt="Logo">
                            @else
                                <img src="{{ asset('images/logo-white.svg') }}" class="img-fluid white-logo app-logo" alt="Logo">
                            @endif

                            @if(isset($appSettings['app_logo']))
                                <img src="{{ asset('storage/' . $appSettings['app_logo']) }}" class="img-fluid dark-logo app-logo" alt="Logo">
                            @else
                                <img src="{{ asset('images/logo.svg') }}" class="img-fluid dark-logo app-logo" alt="Logo">
                            @endif
                        </a>
                        <a href="{{ route('home') }}" class="navbar-brand logo-small">
                            @if(isset($appSettings['app_favicon']))
                                <img src="{{ asset('storage/' . $appSettings['app_favicon']) }}" class="img-fluid" alt="Logo">
                            @else
                                <img src="{{ asset('images/logo-small.png') }}" class="img-fluid" alt="Logo">
                            @endif
                        </a>                    
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="{{ route('home') }}" class="menu-logo">
                                @if(isset($appSettings['app_logo']))
                                    <img src="{{ asset('storage/' . $appSettings['app_logo']) }}" class="img-fluid" alt="Logo">
                                @else
                                    <img src="{{ asset('images/logo.svg') }}" class="img-fluid" alt="Logo">
                                @endif
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                        </div>
                        <ul class="main-nav">
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                <a href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="{{ request()->routeIs('public.articles.index') ? 'active' : '' }}">
                                <a href="{{ route('public.articles.index') }}">Artikel</a>
                            </li>
                            <li class="{{ request()->routeIs('cars.index') ? 'active' : '' }}">
                                <a href="{{ route('cars.index') }}">List Kendaraan</a>
                            </li>
                            <li class="{{ request()->routeIs('drivers.index') ? 'active' : '' }}">
                                <a href="{{ route('drivers.index') }}">List Supir</a>
                            </li>
                            <li>
                                <a href="contact-us.html">Kontak</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link header-login" href="{{ route('login') }}"><span><i class="fa-regular fa-user"></i></span>Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link header-reg" href="{{ route('register') }}"><span><i class="fa-solid fa-lock"></i></span>Daftar</a>
                            </li>
                        @endguest
                        @auth
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a href="#" class="dropdown-toggle nav-link p-0" data-bs-toggle="dropdown">
                                <span class="user-img">
                                    <img class="rounded-circle" src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('customer_assets/images/user-06.jpg') }}" alt="Profile" style="width:36px; height:36px; object-fit:cover;">
                                </span>
                                <span class="user-text text-white ms-2">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="feather-user-check"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form-header').submit();">
                                    <i class="feather-power"></i> Logout
                                </a>
                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>
        <!-- /Header -->
        
        <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">@yield('title', 'User Dashboard')</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Dashboard')</li>
                            </ol>
                        </nav>                          
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadscrumb Section -->               
        
        <!-- Dashboard Menu -->
        <div class="dashboard-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                        <img src="{{ asset('customer_assets/images/dashboard-icon.svg') }}" alt="Icon">
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('my-bookings.index') }}" class="{{ request()->routeIs('my-bookings.*') ? 'active' : '' }}">
                                        <img src="{{ asset('customer_assets/images/booking-icon.svg') }}" alt="Icon">
                                        <span>My Bookings</span>
                                    </a>
                                </li>
                                <!-- 
                                <li>
                                    <a href="user-reviews.html">
                                        <img src="{{ asset('customer_assets/images/review-icon.svg') }}" alt="Icon">
                                        <span>Reviews</span>
                                    </a>
                                </li>
                                -->
                                <li>
                                    <a href="{{ route('profile.settings') }}" class="{{ request()->routeIs('profile.settings') ? 'active' : '' }}">
                                        <img src="{{ asset('customer_assets/images/settings-icon.svg') }}" alt="Icon">
                                        <span>Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Dashboard Menu -->

        <!-- Page Content -->
        <div class="content dashboard-content">
            <div class="container">
                @yield('content')
            </div>          
        </div>
        <!-- /Page Content -->

        <!-- Footer -->
        <footer class="footer footer-four"> 
            <!-- Footer Top --> 
            <div class="footer-top aos" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="footer-contact footer-widget">
                                <div class="footer-logo">
                                    @if(isset($appSettings['app_logo_white']))
                                        <img src="{{ asset('storage/' . $appSettings['app_logo_white']) }}" class="img-fluid aos app-logo" alt="logo">
                                    @else
                                        <img src="{{ asset('images/logo-white.svg') }}" class="img-fluid aos app-logo" alt="logo">
                                    @endif
                                </div>
                                <div class="footer-contact-info">
                                    <p>{{ $appSettings['meta_description'] ?? 'We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles.' }}</p>
                                </div>  
                                <div class="d-flex align-items-center gap-1 app-icon">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('images/gpay.svg') }}" class="img-fluid" alt="logo">
                                    </a>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('images/app.svg') }}" class="img-fluid" alt="logo">
                                    </a>
                                </div>
                                <ul class="social-icon">
                                    @if(isset($appSettings['social_facebook']))
                                    <li>
                                        <a href="{{ $appSettings['social_facebook'] }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    @endif
                                    @if(isset($appSettings['social_instagram']))
                                    <li>
                                        <a href="{{ $appSettings['social_instagram'] }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    @endif
                                    @if(isset($appSettings['social_linkedin']))
                                    <li>
                                        <a href="{{ $appSettings['social_linkedin'] }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                    </li>
                                    @endif
                                    @if(isset($appSettings['social_twitter']))
                                    <li>
                                        <a href="{{ $appSettings['social_twitter'] }}" target="_blank"><i class="fab fa-twitter"></i> </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                @if(isset($footerColumns) && $footerColumns->count() > 0)
                                    @foreach($footerColumns as $column)
                                    <div class="col-lg-4 col-md-6">
                                        <!-- Footer Widget -->
                                        <div class="footer-widget footer-menu">
                                            <h5 class="footer-title">{{ $column->title }}</h5>
                                            <ul>
                                                @foreach($column->links as $link)
                                                <li>
                                                    <a href="{{ $link->url }}">{{ $link->label }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- /Footer Widget -->
                                    </div>
                                    @endforeach
                                @endif
                            </div>                          
                        </div>
                    </div>                  
                </div>
            </div>
            <!-- /Footer Top -->

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container">
                    <!-- Copyright -->
                    <div class="copyright">
                        <div class="row align-items-center row-gap-3">
                            <div class="col-lg-4">
                                <div class="copyright-text">
                                    <p>{{ $appSettings['footer_copyright'] ?? 'Copyright 2025 Dreams Rent. All Rights Reserved.' }}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="payment-list">
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('images/payment-01.svg') }}" alt="img">
                                    </a>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('images/payment-02.svg') }}" alt="img">
                                    </a>
                                    <a href="javascript:void(0);">
                                        <img src="{{ asset('images/payment-03.svg') }}" alt="img">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <ul class="privacy-link">
                                    <li>
                                        <a href="javascript:void(0)">Privacy</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Terms & Condition</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Refund Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Copyright -->
                </div>
            </div>
            <!-- /Footer Bottom -->         
        </footer>
        <!-- /Footer -->
        
    </div>

    <!-- scrollToTop start -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;"></path>
        </svg>
    </div>
    <!-- scrollToTop end -->
    
    <!-- jQuery -->
    <script src="{{ asset('customer_assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('customer_assets/js/bootstrap.bundle.min.js') }}"></script>  

    <!-- Select2 JS -->
    <script src="{{ asset('customer_assets/js/select2.min.js') }}"></script>
    
    <!-- Top JS -->
    <script src="{{ asset('customer_assets/js/backToTop.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('customer_assets/js/script.js') }}"></script>
    
    @stack('scripts')

</body>
</html>
