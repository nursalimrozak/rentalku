<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>RentalKu - Admin Dashboard</title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin_assets/images/favicon.png') }}">

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
						<img src="{{ asset('admin_assets/images/logo.svg') }}" alt="Logo">
					</a>
					<a href="{{ route('dashboard') }}" class="dark-logo">
						<img src="{{ asset('admin_assets/images/logo-white.svg') }}" alt="Logo">
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
					<img src="{{ asset('admin_assets/images/logo.svg') }}" alt="Logo">
				</a>
				<a href="{{ route('dashboard') }}" class="logo-small">
					<img src="{{ asset('admin_assets/images/logo-small.svg') }}" alt="Logo">
				</a>
				<a href="{{ route('dashboard') }}" class="dark-logo">
					<img src="{{ asset('admin_assets/images/logo-white.svg') }}" alt="Logo">
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
									<a href="{{ route('admin.seasonal-prices.index') }}">
										<i class="ti ti-file-dollar"></i><span>Seasonal Pricing</span>
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
									<a href="pages.html">
										<i class="ti ti-file-invoice"></i><span>Pages</span>
									</a>
								</li>
								<li>
									<a href="menu-management.html">
										<i class="ti ti-menu-2"></i><span>Menu Management</span>
									</a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-device-desktop-analytics"></i><span>Blogs</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="blogs.html">All Blogs</a></li>
										<li><a href="blog-categories.html">Categories</a></li>
										<li><a href="blog-comments.html">Comments</a></li>
										<li><a href="blog-tags.html">Blog Tags</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-map"></i><span>Locations</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="countries.html">Countries</a></li>
										<li><a href="state.html">States</a></li>
										<li><a href="city.html">Cities</a></li>
									</ul>
								</li>
								<li>
									<a href="testimonials.html">
										<i class="ti ti-brand-hipchat"></i><span>Testimonials</span>
									</a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-question-mark"></i><span>FAQ’s</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="faq.html">FAQ's</a></li>
										<li><a href="faq-category.html">FAQ Category</a></li>
									</ul>
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
						<li class="menu-title"><span>UI Interface</span></li>
						<li>
							<ul>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-hierarchy"></i><span>Base UI</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="ui-alerts.html">Alerts</a></li>
										<li><a href="ui-accordion.html">Accordion</a></li>
										<li><a href="ui-avatar.html">Avatar</a></li>
										<li><a href="ui-badges.html">Badges</a></li>
										<li><a href="ui-borders.html">Border</a></li>
										<li><a href="ui-buttons.html">Buttons</a></li>
										<li><a href="ui-buttons-group.html">Button Group</a></li>
										<li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
										<li><a href="ui-cards.html">Card</a></li>
										<li><a href="ui-carousel.html">Carousel</a></li>
										<li><a href="ui-colors.html">Colors</a></li>
										<li><a href="ui-dropdowns.html">Dropdowns</a></li>
										<li><a href="ui-grid.html">Grid</a></li>
										<li><a href="ui-images.html">Images</a></li>
										<li><a href="ui-lightbox.html">Lightbox</a></li>
										<li><a href="ui-media.html">Media</a></li>
										<li><a href="ui-modals.html">Modals</a></li>
										<li><a href="ui-offcanvas.html">Offcanvas</a></li>
										<li><a href="ui-pagination.html">Pagination</a></li>
										<li><a href="ui-popovers.html">Popovers</a></li>
										<li><a href="ui-progress.html">Progress</a></li>
										<li><a href="ui-placeholders.html">Placeholders</a></li>
										<li><a href="ui-spinner.html">Spinner</a></li>
										<li><a href="ui-sweetalerts.html">Sweet Alerts</a></li>
										<li><a href="ui-nav-tabs.html">Tabs</a></li>
										<li><a href="ui-toasts.html">Toasts</a></li>
										<li><a href="ui-tooltips.html">Tooltips</a></li>
										<li><a href="ui-typography.html">Typography</a></li>
										<li><a href="ui-video.html">Video</a></li>
										<li><a href="ui-sortable.html">Sortable</a></li>
										<li><a href="ui-swiperjs.html">Swiperjs</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-whirl"></i><span>Advanced UI</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="ui-ribbon.html">Ribbon</a></li>
										<li><a href="ui-clipboard.html">Clipboard</a></li>
										<li><a href="ui-drag-drop.html">Drag & Drop</a></li>
										<li><a href="ui-rangeslider.html">Range Slider</a></li>
										<li><a href="ui-rating.html">Rating</a></li>
										<li><a href="ui-text-editor.html">Text Editor</a></li>
										<li><a href="ui-counter.html">Counter</a></li>
										<li><a href="ui-scrollbar.html">Scrollbar</a></li>
										<li><a href="ui-stickynote.html">Sticky Note</a></li>
										<li><a href="ui-timeline.html">Timeline</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-forms"></i><span>Forms</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li class="submenu submenu-two">
											<a href="javascript:void(0);">Form Elements<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="form-basic-inputs.html">Basic Inputs</a></li>
												<li><a href="form-checkbox-radios.html">Checkbox & Radios</a></li>
												<li><a href="form-input-groups.html">Input Groups</a></li>
												<li><a href="form-grid-gutters.html">Grid & Gutters</a></li>
												<li><a href="form-select.html">Form Select</a></li>
												<li><a href="form-mask.html">Input Masks</a></li>
												<li><a href="form-fileupload.html">File Uploads</a></li>
											</ul>
										</li>
										<li class="submenu submenu-two">
											<a href="javascript:void(0);">Layouts<span class="menu-arrow inside-submenu"></span></a>
											<ul>
												<li><a href="form-horizontal.html">Horizontal Form</a></li>
												<li><a href="form-vertical.html">Vertical Form</a></li>
												<li><a href="form-floating-labels.html">Floating Labels</a></li>
											</ul>
										</li>
										<li><a href="form-validation.html">Form Validation</a></li>
										<li><a href="form-select2.html">Select2</a></li>
										<li><a href="form-wizard.html">Form Wizard</a></li>
										<li><a href="form-pickers.html">Form Picker</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-table"></i><span>Tables</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="tables-basic.html">Basic Tables </a></li>
										<li><a href="data-tables.html">Data Table </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-chart-pie-3"></i>
										<span>Charts</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="chart-apex.html">Apex Charts</a></li>
										<li><a href="chart-c3.html">Chart C3</a></li>
										<li><a href="chart-js.html">Chart Js</a></li>
										<li><a href="chart-morris.html">Morris Charts</a></li>
										<li><a href="chart-flot.html">Flot Charts</a></li>
										<li><a href="chart-peity.html">Peity Charts</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-icons"></i>
										<span>Icons</span><span class="menu-arrow"></span>
									</a>
									<ul>
										<li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
										<li><a href="icon-tabler.html">Tabler Icons</a></li>
										<li><a href="icon-bootstrap.html">Bootstrap Icons</a></li>
										<li><a href="icon-remix.html">Remix Icons</a></li>
										<li><a href="icon-feather.html">Feather Icons</a></li>
										<li><a href="icon-ionic.html">Ionic Icons</a></li>
										<li><a href="icon-material.html">Material Icons</a></li>
										<li><a href="icon-pe7.html">Pe7 Icons</a></li>
										<li><a href="icon-simpleline.html">Simpleline Icons</a></li>
										<li><a href="icon-themify.html">Themify Icons</a></li>
										<li><a href="icon-weather.html">Weather Icons</a></li>
										<li><a href="icon-typicon.html">Typicon Icons</a></li>
										<li><a href="icon-flag.html">Flag Icons</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);">
										<i class="ti ti-map-2"></i>
										<span>Maps</span>
										<span class="menu-arrow"></span>
									</a>
									<ul>
										<li>
											<a href="maps-vector.html">Vector</a>
										</li>
										<li>
											<a href="maps-leaflet.html">Leaflet</a>
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