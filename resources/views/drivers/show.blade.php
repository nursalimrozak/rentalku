@extends('layouts.app')
@section('main-class', 'listing-page')
@section('header-class', 'header-two')

@section('content')
	<!-- Breadscrumb Section -->
	<div class="breadcrumb-bar">
		<div class="container">
			<div class="row align-items-center text-center">
				<div class="col-md-12 col-12">
					<h2 class="breadcrumb-title">Driver Profile</h2>
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="{{ route('drivers.index') }}">Drivers</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ $driver->name }}</li>
						</ol>
					</nav>						
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadscrumb Section -->

	<!-- Driver Detail -->
	<section class="section car-listing">
		<div class="container">
			<div class="row">
				<!-- Driver Info -->
				<div class="col-lg-8">
					<div class="card mb-4">
						<div class="card-body">
							<div class="d-flex align-items-start gap-4 mb-4">
								<div class="driver-photo">
									@if($driver->photo)
										<img src="{{ asset($driver->photo) }}" class="img-fluid rounded" alt="{{ $driver->name }}" style="width: 200px; height: 200px; object-fit: cover;">
									@else
										<img src="{{ asset('images/avatar-default.png') }}" class="img-fluid rounded" alt="{{ $driver->name }}" style="width: 200px; height: 200px; object-fit: cover;">
									@endif
								</div>
								<div class="flex-grow-1">
									<div class="d-flex align-items-center justify-content-between mb-2">
										<h3 class="mb-0">{{ $driver->name }}</h3>
										@if($driver->status == 'available')
											<span class="badge bg-success">Available</span>
										@else
											<span class="badge bg-danger">Busy</span>
										@endif
									</div>
									<div class="mb-3">
										@php
											$rating = $driver->rating ?? 5.0;
											$fullStars = floor($rating);
											$halfStar = ($rating - $fullStars) >= 0.5;
										@endphp
										@for($i = 0; $i < $fullStars; $i++)
											<i class="fas fa-star filled text-warning"></i>
										@endfor
										@if($halfStar)
											<i class="fas fa-star-half-alt filled text-warning"></i>
										@endif
										<span class="ms-2">({{ number_format($rating, 1) }})</span>
									</div>
									<div class="row g-3">
										<div class="col-md-6">
											<div class="d-flex align-items-center">
												<i class="feather-user me-2 text-primary"></i>
												<div>
													<small class="d-block fw-bold text-dark">Gender</small>
													<strong>{{ $driver->gender == 'male' ? 'Male' : 'Female' }}</strong>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="d-flex align-items-center">
												<i class="feather-calendar me-2 text-primary"></i>
												<div>
													<small class="d-block fw-bold text-dark">Age</small>
													<strong>{{ $driver->age }} years old</strong>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="d-flex align-items-center">
												<i class="feather-award me-2 text-primary"></i>
												<div>
													<small class="d-block fw-bold text-dark">Experience</small>
													<strong>{{ $driver->experience_years }} years</strong>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="d-flex align-items-center">
												<i class="feather-phone me-2 text-primary"></i>
												<div>
													<small class="d-block fw-bold text-dark">Phone</small>
													<strong>{{ $driver->phone_number }}</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							@if($driver->bio)
							<div class="border-top pt-4">
								<h5 class="mb-3">About Driver</h5>
								<p class="text-dark">{{ $driver->bio }}</p>
							</div>
							@endif
						</div>
					</div>

					<!-- Documents Section (Optional - for admin view only) -->
					<!-- This section is commented out as documents should not be public -->
					<!--
					<div class="card">
						<div class="card-body">
							<h5 class="mb-3">Documents</h5>
							<div class="row g-3">
								@if($driver->sim)
								<div class="col-md-4">
									<div class="document-item">
										<label class="text-muted">SIM (Driver's License)</label>
										<a href="{{ asset($driver->sim) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2">
											<i class="feather-file-text me-1"></i> View SIM
										</a>
									</div>
								</div>
								@endif
								@if($driver->ktp)
								<div class="col-md-4">
									<div class="document-item">
										<label class="text-muted">KTP (ID Card)</label>
										<a href="{{ asset($driver->ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2">
											<i class="feather-file-text me-1"></i> View KTP
										</a>
									</div>
								</div>
								@endif
								@if($driver->kk)
								<div class="col-md-4">
									<div class="document-item">
										<label class="text-muted">KK (Family Card)</label>
										<a href="{{ asset($driver->kk) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-2">
											<i class="feather-file-text me-1"></i> View KK
										</a>
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					-->
				</div>
				<!-- /Driver Info -->

				<!-- Pricing & Booking -->
				<div class="col-lg-4">
					<div class="card sticky-top" style="top: 100px;">
						<div class="card-body">
							<h5 class="mb-4">Pricing</h5>
							<div class="pricing-info mb-4">
								<div class="d-flex justify-content-between align-items-center mb-3">
									<span class="fw-bold text-dark">In-City Rate</span>
									<h4 class="mb-0 text-dark">Rp {{ number_format($driver->in_city_rate, 0, ',', '.') }}</h4>
								</div>
								<div class="d-flex justify-content-between align-items-center mb-3">
									<span class="fw-bold text-dark">Out-of-Town Rate</span>
									<h4 class="mb-0 text-dark">Rp {{ number_format($driver->out_of_town_rate, 0, ',', '.') }}</h4>
								</div>
								<small class="text-secondary">* Prices are per day</small>
							</div>

							<div class="d-grid gap-2">
								<a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">
									<i class="feather-calendar me-2"></i>Book with Driver
								</a>
								<a href="{{ route('drivers.index') }}" class="btn btn-outline-secondary">
									<i class="feather-arrow-left me-2"></i>Back to Drivers
								</a>
							</div>

							<div class="mt-4 pt-4 border-top">
								<h6 class="mb-3">Why Choose This Driver?</h6>
								<ul class="list-unstyled">
									<li class="mb-2"><i class="feather-check-circle text-success me-2"></i>Professional & Experienced</li>
									<li class="mb-2"><i class="feather-check-circle text-success me-2"></i>Highly Rated</li>
									<li class="mb-2"><i class="feather-check-circle text-success me-2"></i>Safe Driving Record</li>
									<li class="mb-2"><i class="feather-check-circle text-success me-2"></i>Friendly & Helpful</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /Pricing & Booking -->
			</div>
		</div>
	</section>
	<!-- /Driver Detail -->
@endsection
