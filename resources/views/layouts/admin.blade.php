<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>{{ $appSettings['meta_title'] ?? $appSettings['app_name'] ?? 'RentalKu' }} - Admin Dashboard</title>
	
	<!-- Favicon -->
	@if(isset($appSettings['app_favicon']))
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $appSettings['app_favicon']) }}">
	@else
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin_assets/images/favicon.png') }}">
	@endif

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/css/tabler-icons.min.css') }}">

    <!-- Daterangpicker CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/css/daterangepicker.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">

    @stack('styles')

</head>

<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header">
			<div class="main-header">
			
				<div class="header-left">
					<a href="{{ route('dashboard') }}" class="logo">
						@if(isset($appSettings['app_logo']))
							<img src="{{ asset('storage/' . $appSettings['app_logo']) }}" class="img-fluid" alt="Logo">
						@else
							<img src="{{ asset('admin_assets/images/logo.svg') }}" alt="Logo">
						@endif
					</a>
					<a href="{{ route('dashboard') }}" class="dark-logo">
						@if(isset($appSettings['app_logo_white']))
							<img src="{{ asset('storage/' . $appSettings['app_logo_white']) }}" class="img-fluid" alt="Logo">
						@else
							<img src="{{ asset('admin_assets/images/logo-white.svg') }}" alt="Logo">
						@endif
					</a>
				</div>

				<a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<div class="header-user">
					<div class="nav user-menu nav-list">
	
						<div class="me-auto d-flex align-items-center" id="header-search">					
							<a id="toggle_btn" href="javascript:void(0);">
								<i class="ti ti-menu-deep"></i>
							</a>		
						</div>
	
						<div class="d-flex align-items-center header-icons">	

							<div class="theme-item">
								<a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle btn btn-menubar">
									<i class="ti ti-moon"></i>
								</a>
								<a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle btn btn-menubar">
									<i class="ti ti-sun-high"></i>
								</a>
							</div>
							
							<div class="dropdown profile-dropdown">
								<a href="javascript:void(0);" class="d-flex align-items-center" data-bs-toggle="dropdown" data-bs-auto-close="outside">
									<span class="avatar avatar-sm">
										<img src="{{ asset('admin_assets/images/avatar-01.jpg') }}" alt="Img" class="img-fluid rounded-circle">
									</span>
								</a>
								<div class="dropdown-menu">
									<div class="profileset d-flex align-items-center">
										<span class="user-img me-2">
											<img src="{{ asset('admin_assets/images/avatar-01.jpg') }}" alt="">
										</span>
										<div>
											<h6 class="fw-semibold mb-1">{{ auth()->user()->name ?? 'Admin' }}</h6>
											<p class="fs-13">{{ ucfirst(auth()->user()->role ?? 'Admin') }}</p>
										</div>
									</div>
									<a class="dropdown-item d-flex align-items-center" href="#">
										<i class="ti ti-user-edit me-2"></i>My Profile
									</a>
									<div class="dropdown-divider my-2"></div>
									<a class="dropdown-item logout d-flex align-items-center justify-content-between" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">
										<span><i class="ti ti-logout me-2"></i>Logout</span>
									</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="#">My Profile</a>
						<a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->

			</div>

		</div>
		<!-- /Header -->

		<!-- Sidebar -->
		<div class="sidebar" id="sidebar">
			<!-- Logo -->
			<div class="sidebar-logo">
				<a href="{{ route('dashboard') }}" class="logo logo-normal">
					@if(isset($appSettings['app_logo']))
						<img src="{{ asset('storage/' . $appSettings['app_logo']) }}" class="img-fluid" alt="Logo">
					@else
						<img src="{{ asset('admin_assets/images/logo.svg') }}" alt="Logo">
					@endif
				</a>
				<a href="{{ route('dashboard') }}" class="logo-small">
					@if(isset($appSettings['app_favicon']))
						<img src="{{ asset('storage/' . $appSettings['app_favicon']) }}" class="img-fluid" alt="Logo">
					@else
						<img src="{{ asset('admin_assets/images/logo-small.svg') }}" alt="Logo">
					@endif
				</a>
				<a href="{{ route('dashboard') }}" class="dark-logo">
					@if(isset($appSettings['app_logo_white']))
						<img src="{{ asset('storage/' . $appSettings['app_logo_white']) }}" class="img-fluid" alt="Logo">
					@else
						<img src="{{ asset('admin_assets/images/logo-white.svg') }}" alt="Logo">
					@endif
				</a>
			</div>
			<!-- /Logo -->
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					
					<div class="form-group">
						<!-- Search -->
						<div class="input-group input-group-flat d-inline-flex">
							<span class="input-icon-addon">
								<i class="ti ti-search"></i>
							  </span>
							<input type="text" class="form-control" placeholder="Search">
							<span class="group-text">
								<i class="ti ti-command"></i>
							</span>
						</div>
						<!-- /Search -->
					</div>
					<ul>
						<li class="menu-title"><span>Main</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
									<a href="{{ route('dashboard') }}">
										<i class="ti ti-layout-dashboard"></i><span>Dashboard</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>Bookings</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
									<a href="{{ route('admin.bookings.index') }}">
										<i class="ti ti-files"></i><span>Reservations</span><span class="track-icon"></span>
									</a>
								</li>
								<li>
									<a href="calendar.html">
										<i class="ti ti-calendar-bolt"></i><span>Calendar</span>
									</a>
								</li>
								<li>
									<a href="quotations.html">
										<i class="ti ti-file-symlink"></i><span>Quotations</span>
									</a>
								</li>
								<li>
									<a href="enquiries.html">
										<i class="ti ti-mail"></i><span>Enquiries</span>
									</a>
								</li>
							</ul>							
						</li>
						<li class="menu-title"><span>Manage</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
									<a href="{{ route('admin.customers.index') }}">
										<i class="ti ti-users-group"></i><span>Customers</span>
									</a>
								</li>
								<li class="{{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
									<a href="{{ route('admin.drivers.index') }}">
										<i class="ti ti-user-bolt"></i><span>Drivers</span>
									</a>
								</li>
								<li>
									<a href="locations.html">
										<i class="ti ti-map-pin"></i><span>Locations</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>RENTALS</span></li>
						<li>
							<ul>
								<li class="{{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
									<a href="{{ route('admin.cars.index') }}">
										<i class="ti ti-car"></i><span>Cars</span>
									</a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-device-camera-phone"></i><span>Car Attributes</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="brands.html">Brands</a></li>
										<li><a href="types.html">Types</a></li>
										<li><a href="models.html">Models</a></li>
										<li><a href="transmissions.html">Transmissions</a></li>
										<li><a href="fuel.html">Fuels</a></li>
										<li><a href="color.html">Colors</a></li>
										<li><a href="steering.html">Steering</a></li>
										<li><a href="seats.html">Seats</a></li>
										<li><a href="cylinders.html">Cylinders</a></li>
										<li><a href="doors.html">Doors</a></li>
										<li><a href="features.html">Features</a></li>
										<li><a href="safety-features.html">Safty Features</a></li>
									</ul>
								</li>
								<li>
									<a href="extra-services.html">
										<i class="ti ti-script-plus"></i><span>Extra Service</span>
									</a>
								</li>


								<li>
									<a href="inspections.html">
										<i class="ti ti-dice-6"></i><span>Inspections</span>
									</a>
								</li>
								<li>
									<a href="tracking.html">
										<i class="ti ti-map-pin-pin"></i><span>Tracking</span>
									</a>
								</li>
								<li class="{{ request()->routeIs('admin.maintenances.*') ? 'active' : '' }}">
									<a href="{{ route('admin.maintenances.index') }}">
										<i class="ti ti-color-filter"></i><span>Maintenance</span>
									</a>
								</li>
								<li>
									<a href="reviews.html">
										<i class="ti ti-star"></i><span>Reviews</span>
									</a>
								</li>
							</ul>
						</li>	
						<li class="menu-title"><span>FINANCE & ACCOUNTS</span></li>					
						<li>
							<ul>
								<li>
									<a href="invoices.html">
										<i class="ti ti-file-invoice"></i><span>Invoices</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
										<i class="ti ti-credit-card"></i><span>Payments</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.bank-accounts.index') }}" class="{{ request()->routeIs('admin.bank-accounts.*') ? 'active' : '' }}">
										<i class="ti ti-building-bank"></i><span>Bank Accounts</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>OTHERS</span></li>
						<li>
							<ul>
								<li>
									<a href="chat.html">
										<i class="ti ti-message"></i><span>Messages</span><span class="count">5</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.vouchers.index') }}">
										<i class="ti ti-discount-2"></i><span>Coupons</span>
									</a>
								</li>
								<li>
									<a href="newsletters.html">
										<i class="ti ti-file-horizontal"></i><span>Newsletters</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>CMS</span></li>
						<li>
							<ul>
								<li>
									<a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
										<i class="ti ti-settings"></i><span>Application Settings</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.footer.index') }}" class="{{ request()->routeIs('admin.footer.*') ? 'active' : '' }}">
										<i class="ti ti-layout-bottombar"></i><span>Footer Manager</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.section-settings.index') }}" class="{{ request()->routeIs('admin.section-settings.*') ? 'active' : '' }}">
										<i class="ti ti-settings"></i><span>Section Settings</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
										<i class="ti ti-tags"></i><span>Brands</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.features.index') }}" class="{{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
										<i class="ti ti-list-check"></i><span>Features</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.rental-steps.index') }}" class="{{ request()->routeIs('admin.rental-steps.*') ? 'active' : '' }}">
										<i class="ti ti-stairs-up"></i><span>Cara Rental</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
										<i class="ti ti-brand-hipchat"></i><span>Testimonials</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
										<i class="ti ti-question-mark"></i><span>FAQs</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
										<i class="ti ti-news"></i><span>Articles</span>
									</a>
								</li>
								<li>
									<a href="{{ route('admin.rental-communities.index') }}" class="{{ request()->routeIs('admin.rental-communities.*') ? 'active' : '' }}">
										<i class="ti ti-users"></i><span>Community Images</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>SUPPORT</span></li>
						<li>
							<ul>
								<li>
									<a href="contact-messages.html">
										<i class="ti ti-messages"></i><span>Contact Messages</span>
									</a>
								</li>
								<li>
									<a href="announcements.html">
										<i class="ti ti-speakerphone"></i><span>Announcements</span>
									</a>
								</li>
								<li>
									<a href="tickets.html">
										<i class="ti ti-ticket"></i><span>Tickets</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>USER MANAGEMENT</span></li>
						<li>
							<ul>
								<li>
									<a href="users.html">
										<i class="ti ti-user-circle"></i><span>Users</span>
									</a>
								</li>
								<li>
									<a href="roles-permissions.html">
										<i class="ti ti-user-shield"></i><span>Roles & Permissions</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>REPORTS</span></li>
						<li>
							<ul>
								<li>
									<a href="income-report.html">
										<i class="ti ti-chart-histogram"></i><span>Income vs Expense</span>
									</a>
								</li>
								<li>
									<a href="earnings-report.html">
										<i class="ti ti-chart-line"></i><span>Earnings</span>
									</a>
								</li>
								<li>
									<a href="rental-report.html">
										<i class="ti ti-chart-infographic"></i><span>Rentals</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>AUTHENTICATION</span></li>
						<li>
							<ul>
								<li>
									<a href="login.html">
										<i class="ti ti-login"></i><span>Login</span>
									</a>
								</li>
								<li>
									<a href="forgot-password.html">
										<i class="ti ti-help-triangle"></i><span>Forgot Password</span>
									</a>
								</li>
								<li>
									<a href="otp.html">
										<i class="ti ti-mail-exclamation"></i><span>Email Verification</span>
									</a>
								</li>
								<li>
									<a href="reset-password.html">
										<i class="ti ti-restore"></i><span>Reset Password</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>SETTINGS & CONFIGURATION</span></li>
						<li>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-user-cog"></i><span>Account Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="profile-setting.html">Profile</a>
										</li>
										<li>
											<a href="security-setting.html">Security</a>
										</li>
										<li>
											<a href="notifications-setting.html">Notifications</a>
										</li>
										<li>
											<a href="integrations-settings.html">Integrations</a>
										</li>
										<li>
											<a href="tracker-setting.html">Tracker</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-world-cog"></i><span>Website Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="company-setting.html">Company Settings</a>
										</li>
										<li>
											<a href="localization-setting.html">Localization</a>
										</li>
										<li>
											<a href="prefixes.html">Prefixes</a>
										</li>
										<li>
											<a href="seo-setup.html">SEO Setup</a>
										</li>
										<li>
											<a href="language-setting.html">Language</a>
										</li>
										<li>
											<a href="maintenance-mode.html">Maintenance Mode</a>
										</li>
										<li>
											<a href="login-setting.html">Login & Register</a>
										</li>
										<li>
											<a href="ai-configuration.html">AI Configuration</a>
										</li>
										<li>
											<a href="plugin-managers.html">Plugin Managers</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-clock-cog"></i><span>Rental Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="rental-setting.html">Rental</a>
										</li>
										<li>
											<a href="insurance-setting.html">Insurance</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-device-mobile-cog"></i><span>App Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="invoice-setting.html">Invoice Settings</a>
										</li>
										<li>
											<a href="invoice-template.html">Invoice Templates</a>
										</li>
										<li>
											<a href="signatures-setting.html">Signatures</a>
										</li>
										<li>
											<a href="custom-fields.html">Custom Fields</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-device-desktop-cog"></i><span>System Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="email-setting.html">Email Settings</a>
										</li>
										<li>
											<a href="email-templates.html">Email Templates</a>
										</li>
										<li>
											<a href="sms-gateways.html">SMS Gateways</a>
										</li>
										<li>
											<a href="gdpr-cookies.html">GDPR Cookies</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-settings-dollar"></i><span>Finance Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="payment-methods.html">Payment Methods</a>
										</li>
										<li>
											<a href="bank-accounts.html">Bank Accounts</a>
										</li>
										<li>
											<a href="tax-rates.html">Tax Rates</a>
										</li>
										<li>
											<a href="currencies.html">Currencies</a>
										</li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-settings-2"></i><span>Other Settings</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="sitemap.html">Sitemap</a>
										</li>
										<li>
											<a href="clear-cache.html">Clear Cache</a>
										</li>
										<li>
											<a href="storage.html">Storage</a>
										</li>
										<li>
											<a href="cronjob.html">Cronjob</a>
										</li>
										<li>
											<a href="system-backup.html">System Backup</a>
										</li>
										<li>
											<a href="database-backup.html">Database Backup</a>
										</li>
										<li>
											<a href="system-update.html">System Update</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="menu-title"><span>Extras</span></li>
						<li>
							<ul>
								<li>
									<a href="https://dreamsrent.dreamstechnologies.com/documentation/html.html"><i class="ti ti-file-shredder"></i><span>Documentation</span></a>
								</li>
								<li>
									<a href="https://dreamsrent.dreamstechnologies.com/documentation/changelog.html"><i class="ti ti-exchange"></i><span>Changelog</span></a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-menu-2"></i><span>Multi Level</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="javascript:void(0);">Multilevel 1</a></li>
										<li class="submenu submenu-two">
											<a href="javascript:void(0);">Multilevel 2<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="javascript:void(0);">Multilevel 2.1</a></li>
												<li class="submenu submenu-two submenu-three">
													<a href="javascript:void(0);">Multilevel 2.2<span class="menu-arrow inside-submenu inside-submenu-two"></span></a>
													<ul>
														<li><a href="javascript:void(0);">Multilevel 2.2.1</a></li>
														<li><a href="javascript:void(0);">Multilevel 2.2.2</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li><a href="javascript:void(0);">Multilevel 3</a></li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Sidebar -->

		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content pb-0">
                @yield('content')
            </div>

            <!-- Footer-->
			<div class="footer d-sm-flex align-items-center justify-content-between bg-white p-3">
				<p class="mb-0">
                    <a href="javascript:void(0);">Privacy Policy</a>
                    <a href="javascript:void(0);" class="ms-4">Terms of Use</a>
                </p>
				<p> 2025 Dreamsrent, Made with <span class="text-danger">❤</span> by <a href="javascript:void(0);" class="text-secondary">Dreams</a></p>
			</div>
			<!-- /Footer-->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script data-cfasync="false" src="{{ asset('admin_assets/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-3.7.1.min.js') }}"></script>

	<!-- Feather Icon JS -->
	<script src="{{ asset('admin_assets/js/feather.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Slimscroll JS -->
	<script src="{{ asset('admin_assets/js/jquery.slimscroll.min.js') }}"></script>
	
	<!-- Daterangepikcer JS -->
	<script src="{{ asset('admin_assets/js/moment.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/daterangepicker.js') }}"></script>
	<script src="{{ asset('admin_assets/js/bootstrap-datetimepicker.min.js') }}"></script>

	<!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('admin_assets/js/bootstrap-tagsinput.min.js') }}"></script>

	<!-- ApexChart JS -->
	<script src="{{ asset('admin_assets/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/chart-data_1.js') }}"></script>

	<!-- Peity Chart -->
    <script src="{{ asset('admin_assets/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/chart-data.js') }}"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
	<script src="{{ asset('admin_assets/js/map.js') }}"></script>

	<!-- Custom JS -->
	<script src="{{ asset('admin_assets/js/script.js') }}"></script>

    @stack('scripts')

</body>
</html>