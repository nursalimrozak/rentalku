<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Rentalku - User Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('customer_assets/images/favicon.png') }}">
    
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
        .header.header-four {
            background-color: #121212 !important;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .main-wrapper {
            padding-top: 85px;
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
                            <img src="{{ asset('customer_assets/images/logo.svg') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a href="{{ route('home') }}" class="navbar-brand logo-small">
                            <img src="{{ asset('customer_assets/images/logo-small.png') }}" class="img-fluid" alt="Logo">
                        </a>                            
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="{{ route('home') }}" class="menu-logo">
                                <img src="{{ asset('customer_assets/images/logo.svg') }}" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
                        </div>
                        <ul class="main-nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                             @auth
                                <li class="active">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                             @endauth
                        </ul>
                    </div>
                    <ul class="nav header-navbar-rht">
                        <!-- User Menu -->
                        @auth
                        <li class="nav-item dropdown has-arrow logged-item">
                            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                <span class="user-img">
                                    <img class="rounded-circle" src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('customer_assets/images/avatar-14.jpg') }}" alt="Profile" style="width:30px; height:30px; object-fit:cover;">
                                </span>
                                <span class="user-text">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="feather-user-check"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.settings') }}">
                                    <i class="feather-settings"></i> Settings
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form-header').submit();">
                                    <i class="feather-power"></i> Logout
                                </a>
                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @else
                        <li class="login-link">
                            <a href="{{ route('register') }}">Sign Up</a>
                        </li>
                        <li class="login-link">
                            <a href="{{ route('login') }}">Sign In</a>
                        </li>
                        @endauth
                        <!-- /User Menu -->
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
                                    <img src="{{ asset('images/logo-white.svg') }}" class="img-fluid aos" alt="logo">
                                </div>
                                <div class="footer-contact-info">
                                    <p>We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles. </p>
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
                                    <li>
                                        <a href="javascript:void(0)"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="fab fa-behance"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="fab fa-twitter"></i> </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><i class="fab fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-menu">
                                        <h5 class="footer-title">Quick Links</h5>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">My account</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Campaigns</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Dreams rent Dealers</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Deals and Incentive</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Financial Services</a>
                                            </li>                           
                                        </ul>
                                    </div>
                                    <!-- /Footer Widget -->
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-menu">
                                        <h5 class="footer-title">Pages</h5>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">About Us</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Become a Partner</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Faq’s</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Testimonials</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Contact Us</a>
                                            </li>                           
                                        </ul>
                                    </div>
                                    <!-- /Footer Widget -->
                                </div>  
                                <div class="col-lg-4 col-md-6">
                                    <!-- Footer Widget -->
                                    <div class="footer-widget footer-menu">
                                        <h5 class="footer-title">Useful Links</h5>
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0)">My account</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Campaigns</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Dreams rent Dealers</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Deals and Incentive</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">Financial Services</a>
                                            </li>                           
                                        </ul>
                                    </div>
                                    <!-- /Footer Widget -->
                                </div>                                  
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
                                    <p>Copyright  2025 Dreams Rent. All Rights Reserved.</p>
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
