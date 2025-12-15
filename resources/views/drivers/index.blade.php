@extends('layouts.app')
@section('main-class', 'listing-page')
@section('header-class', 'header-two')

@section('content')
	<!-- Breadscrumb Section -->
	<div class="breadcrumb-bar">
		<div class="container">
			<div class="row align-items-center text-center">
				<div class="col-md-12 col-12">
					<h2 class="breadcrumb-title">Our Drivers</h2>
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Drivers</li>
						</ol>
					</nav>						
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadscrumb Section -->

	<!-- Drivers Grid View -->
	<section class="section car-listing">
		<div class="container">
			<div class="row">
				@forelse($drivers as $driver)
				<!-- col -->
				<div class="col-xxl-4 col-lg-4 col-md-6 col-12">
					<div class="listing-item">						
						<div class="listing-img">
							<a href="{{ route('drivers.show', $driver->id) }}">
								@if($driver->photo)
									<img src="{{ asset($driver->photo) }}" class="img-fluid" alt="{{ $driver->name }}" style="height: 300px; object-fit: cover; width: 100%;">
								@else
									<img src="{{ asset('images/avatar-default.png') }}" class="img-fluid" alt="{{ $driver->name }}" style="height: 300px; object-fit: cover; width: 100%;">
								@endif
							</a>
							<div class="fav-item justify-content-end">
								@if($driver->status == 'available')
									<span class="badge bg-success">Available</span>
								@else
									<span class="badge bg-danger">Busy</span>
								@endif
							</div>
						</div>						
						<div class="listing-content">
							<div class="listing-features">
								<div class="list-rating">
									<h3 class="listing-title">
										<a href="{{ route('drivers.show', $driver->id) }}">{{ $driver->name }}</a>
									</h3>										  
									<div class="list-rating">		
										@php
											$rating = $driver->rating ?? 5.0;
											$fullStars = floor($rating);
											$halfStar = ($rating - $fullStars) >= 0.5;
										@endphp
										@for($i = 0; $i < $fullStars; $i++)
											<i class="fas fa-star filled"></i>
										@endfor
										@if($halfStar)
											<i class="fas fa-star-half-alt filled"></i>
										@endif
										<span>({{ number_format($rating, 1) }})</span>
									</div>
								</div>
							</div> 
							<div class="listing-details-group">
								<ul>
									<li>
										<span><i class="feather-user me-2"></i></span>
										<p>{{ $driver->gender == 'male' ? 'Male' : 'Female' }}</p>
									</li>
									<li>
										<span><i class="feather-calendar me-2"></i></span>
										<p>{{ $driver->age }} years old</p>
									</li>
									<li>
										<span><i class="feather-award me-2"></i></span>
										<p>{{ $driver->experience_years }} years exp</p>
									</li>
								</ul>	
							</div>
							<div class="listing-location-details">
								<div class="listing-price">
									<p class="mb-0 text-muted">Starts from</p>
									<h6 class="text-primary fw-bold">Rp {{ number_format($driver->in_city_rate, 0, ',', '.') }} <span>/ Day</span></h6>
								</div>
								<div class="listing-button">
									<a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-order"><span><i class="feather-eye me-2"></i></span>View Profile</a>
								</div>	
							</div>
						</div>
					</div>	
				</div>
				<!-- /col -->
				@empty
				<div class="col-12">
					<div class="alert alert-info text-center">
						<h4>No drivers available at the moment</h4>
						<p>Please check back later.</p>
					</div>
				</div>
				@endforelse
			</div>
			
			<!-- Pagination -->
			<div class="col-12">
				<div class="blog-pagination">
					{{ $drivers->links('pagination::bootstrap-4') }}
				</div>
			</div>
			<!-- /Pagination -->

		</div>	
	</section>	
	<!-- /Drivers Grid View -->	
@endsection
