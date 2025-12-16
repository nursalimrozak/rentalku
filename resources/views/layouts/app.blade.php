<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>{{ $appSettings['meta_title'] ?? $appSettings['app_name'] ?? 'Dreams Rent' }}</title>

	<!-- Favicon -->
	@if(isset($appSettings['app_favicon']))
		<link rel="shortcut icon" href="{{ asset('storage/' . $appSettings['app_favicon']) }}">
	@else
		<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
	@endif
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
	
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
	
	<!-- Aos CSS -->
	<link rel="stylesheet" href="{{ asset('css/aos.css') }}">
	
    <!-- Fearther CSS -->
	<link rel="stylesheet" href="{{ asset('css/feather.css') }}">
		
	<!-- Owl carousel CSS -->
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">	
		
	<!-- Flatpickr CSS -->
	<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">

	<!-- Fancybox CSS -->
	<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">

	<!-- Slick CSS -->
	<link rel="stylesheet" href="{{ asset('css/slick.css') }}">

   	<!-- Bootstrap Icons -->
   	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
	<!-- Custom CSS -->
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
    </style>
</head>
<body>
	
	<div class="main-wrapper @yield('main-class', 'home-three')">
		
		<!-- Header -->
		<header class="header @yield('header-class', 'header-four')">
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

        @yield('content')

		<!-- Footer -->
		<footer class="footer footer-four">	
			<!-- Footer Top -->	
			<div class="footer-top">
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
										<a href="privacy-policy.html">Privacy</a>
									</li>
									<li>
										<a href="terms-condition.html">Terms & Condition</a>
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
	<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

	<!-- counterup JS -->
	<script src="{{ asset('js/jquery.waypoints.js') }}"></script>
	<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
	
	<!-- Select2 JS -->
	<script src="{{ asset('js/select2.min.js') }}"></script>
	
	<!-- Aos -->
	<script src="{{ asset('js/aos.js') }}"></script>
	
	<!-- Top JS -->
	<script src="{{ asset('js/backToTop.js') }}"></script>
	
	<!-- Owl Carousel JS -->
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <!-- Slick JS -->
    <script src="{{ asset('js/slick.js') }}"></script>	

    <!-- Flatpickr JS -->
    <script src="{{ asset('js/flatpickr.min.js') }}"></script>	
    <script src="{{ asset('js/forms-pickers.js') }}"></script>	
	
	<!-- Datepicker Core JS -->
	<script src="{{ asset('js/moment.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- Fancybox JS -->
	<script src="{{ asset('js/fancybox.umd.js') }}"></script>

	<!-- Custom JS -->
	<script src="{{ asset('js/script.js') }}"></script>
	
    @stack('scripts')



</body>
</html>
