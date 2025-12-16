<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Dreams Rent | Template</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
	
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
            max-width: 50%;
        }
        @media (max-width: 768px) {
            .app-logo {
                max-width: 20%;
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
							<li class="has-submenu megamenu active">
								<a href="index.html">Home <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu mega-submenu">
									<li>
										<div class="megamenu-wrapper">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="single-demo active">
                                                        <div class="demo-img">
                                                            <a href="index.html">
																<img src="{{ asset('images/home-01.svg') }}" class="img-fluid " alt="img">
															</a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index.html">Car Rental<span class="new">New</span> </a>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="index-2.html">
																<img src="{{ asset('images/home-02.svg') }}" class="img-fluid " alt="img">
															</a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-2.html">Car Rental 1<span class="hot">Hot</span> </a>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="index-3.html">
																<img src="{{ asset('images/home-03.svg') }}" class="img-fluid " alt="img">
															</a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-3.html">Bike Rental<span class="new">New</span> </a>
                                                        </div>
                                                    </div>
                                                </div>
												<div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="index-4.html">
																<img src="{{ asset('images/home-04.svg') }}" class="img-fluid " alt="img">
															</a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-4.html">Yacht Rental<span class="new">New</span> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</li>						
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Listings <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li><a href="{{ route('cars.index') }}">Listing Grid</a></li>
								    <li><a href="listing-list.html">Listing List</a></li>
									<li><a href="listing-map.html">Listing With Map</a></li>						
								    <li><a href="listing-details.html">Listing Details</a></li>								
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Pages <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li><a href="about-us.html">About Us</a></li>
								    <li><a href="contact-us.html">Contact</a></li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Authentication</a>
										<ul class="submenu">
											<li><a href="register.html">Sign Up</a></li>
											<li><a href="login.html">Sign In</a></li>
											<li><a href="forgot-password.html">Forgot Password</a></li>
											<li><a href="reset-password.html">Reset Password</a></li>
										</ul>
									</li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Booking</a>
										<ul class="submenu">
											<li><a href="booking-checkout.html">Booking Checkout</a></li>
											<li><a href="booking.html">Booking</a></li>
											<li><a href="invoice-details.html">Invoice Details</a></li>
										</ul>
									</li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Error Page</a>
										<ul class="submenu">
											<li><a href="error-404.html">404 Error</a></li>
											<li><a href="error-500.html">500 Error</a></li>
										</ul>
									</li>
								    <li><a href="pricing.html">Pricing</a></li>
								    <li><a href="faq.html">FAQ</a></li>
								    <li><a href="gallery.html">Gallery</a></li>
								    <li><a href="our-team.html">Our Team</a></li>
								    <li><a href="testimonial.html">Testimonials</a></li>
									<li><a href="terms-condition.html">Terms & Conditions</a></li>
									<li><a href="privacy-policy.html">Privacy Policy</a></li>
									<li><a href="maintenance.html">Maintenance</a></li>
									<li><a href="coming-soon.html">Coming Soon</a></li>							
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Blog <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li><a href="blog-list.html">Blog List</a></li>
									<li><a href="blog-grid.html">Blog Grid</a></li>
									<li><a href="blog-details.html">Blog Details</a></li>																		
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Dashboard <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li class="has-submenu">
										<a href="javascript:void(0);">User Dashboard</a>
										<ul class="submenu">
											<li><a href="user-dashboard.html">Dashboard</a></li>
											<li><a href="user-bookings.html">My Bookings</a></li>
											<li><a href="user-reviews.html">Reviews</a></li>
											<li><a href="user-wishlist.html">Wishlist</a></li>
											<li><a href="user-messages.html">Messages</a></li>
											<li><a href="user-wallet.html">My Wallet</a></li>
											<li><a href="user-payment.html">Payments</a></li>
											<li><a href="user-settings.html">Settings</a></li>			
										</ul>
									</li>		
									<li class="has-submenu">
										<a href="javascript:void(0);">Admin Dashboard</a>
										<ul class="submenu">
											<li><a href="../template/admin/index.html">Dashboard</a></li>
											<li><a href="../template/admin/reservations.html">Bookings</a></li>
											<li><a href="../template/admin/customers.html">Manage</a></li>
											<li><a href="../template/admin/cars.html">Rentals</a></li>
											<li><a href="../template/admin/invoices.html">Finance & Accounts</a></li>
											<li><a href="../template/admin/coupons.html">Others</a></li>
											<li><a href="../template/admin/pages.html">CMS</a></li>			
											<li><a href="../template/admin/contact-messages.html">Support</a></li>			
											<li><a href="../template/admin/users.html">User Management</a></li>			
											<li><a href="../template/admin/earnings-report.html">Reports</a></li>			
											<li><a href="../template/admin/profile-setting.html">Settings & Configuration</a></li>		
										</ul>
									</li>				
								</ul>
							</li>	
							<li class="login-link">
								<a href="register.html">Sign Up</a>
							</li>
							<li class="login-link">
								<a href="login.html">Sign In</a>
							</li>
						</ul>
					</div>
					<ul class="nav header-navbar-rht">
						<li class="nav-item user-link">
							<a class="nav-link btn-secondary btn d-inline-flex align-items-center" href="login.html"><i class="bi bi-person-fill me-1"></i>Sign In</a>
						</li>
						<li class="nav-item">
							<a class="nav-link header-reg  d-inline-flex align-items-center" href="register.html"><span><i class="bi bi-lock-fill"></i></span>Sign Up</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<!-- /Header -->

        @yield('content')

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
												<a href="about-us.html">About Us</a>
											</li>
											<li>
												<a href="javascript:void(0)">Become a Partner</a>
											</li>
											<li>
												<a href="faq.html">Faq’s</a>
											</li>
											<li>
												<a href="testimonial.html">Testimonials</a>
											</li>
											<li>
												<a href="contact-us.html">Contact Us</a>
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
