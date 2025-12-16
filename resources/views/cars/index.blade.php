@extends('layouts.app')
@section('main-class', 'listing-page')


@push('styles')
	<!-- Rangeslider CSS -->
	<link rel="stylesheet" href="{{ asset('css/ion.rangeSlider.min.css') }}">
@endpush

@section('content')
	<!-- Breadscrumb Section -->
	<div class="breadcrumb-bar">
		<div class="container">
			<div class="row align-items-center text-center">
				<div class="col-md-12 col-12">
					<h2 class="breadcrumb-title">List Kendaraan</h2>
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
							<li class="breadcrumb-item"><a href="javascript:void(0);">List</a></li>
							<li class="breadcrumb-item active" aria-current="page">List Kendaraan</li>
						</ol>
					</nav>							
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadscrumb Section -->

	<!-- Search -->	
	<div class="section-search page-search"> 
		<div class="container">	  
			<div class="search-box-banner">
				<form action="{{ route('cars.index') }}">
					<ul class="align-items-center justify-content-center">
						<li class="column-group-main">						
							<div class="input-block">																	
								<label>Pickup Date</label>
							</div>
							<div class="input-block-wrapp">
								<div class="input-block date-widget">												
									<div class="group-img">
									<input type="text" name="pickup_date" class="form-control datetimepicker" placeholder="dd/mm/yyyy" value="{{ request('pickup_date') }}">
									<span><i class="feather-calendar"></i></span>
									</div>
								</div>
								<div class="input-block time-widge">											
									<div class="group-img">
									<input type="text" name="pickup_time" class="form-control timepicker" placeholder="11:00 AM" value="{{ request('pickup_time') }}">
									<span><i class="feather-clock"></i></span>
									</div>
								</div>
							</div>	
						</li>
						<li class="column-group-main">						
							<div class="input-block">																	
								<label>Return Date</label>
							</div>
							<div class="input-block-wrapp">
								<div class="input-block date-widge">												
									<div class="group-img">
									<input type="text" name="return_date" class="form-control datetimepicker" placeholder="dd/mm/yyyy" value="{{ request('return_date') }}">
									<span><i class="feather-calendar"></i></span>
									</div>
								</div>
								<div class="input-block time-widge">											
									<div class="group-img">
									<input type="text" name="return_time" class="form-control timepicker" placeholder="11:00 AM" value="{{ request('return_time') }}">
									<span><i class="feather-clock"></i></span>
									</div>
								</div>
							</div>	
						</li>
						<li class="column-group-last">
							<div class="input-block">
								<div class="search-btn">
									<button class="btn search-button" type="submit"> <i class="fa fa-search" aria-hidden="true"></i>Search</button>
								</div>
							</div>
						</li>
					</ul>
				</form>	
			</div>
		</div>	
	</div>	
	<!-- /Search -->

	<!-- Sort By -->	
	<div class="sort-section">
		<div class="container">
			<div class="sortby-sec">
				<div class="sorting-div">
					<div class="row d-flex align-items-center">
						<div class="col-xl-4 col-lg-3 col-sm-12 col-12">
							<div class="count-search">
								<p>Showing 1-9 of 154 Cars</p>
							</div>
						</div>
						<div class="col-xl-8 col-lg-9 col-sm-12 col-12">
							<div class="product-filter-group">
								<div class="sortbyset">
									<ul>
										<li>
											<span class="sortbytitle">Show : </span>
											<div class="sorting-select select-one">
												<select class="form-control select">
													<option>5</option>
													<option>10</option>
													<option>15</option>
													<option>20</option>
													<option>30</option>
												</select>
											</div>
										</li>
										<li>
											<span class="sortbytitle">Sort By </span>
											<div class="sorting-select select-two">
												<select class="form-control select">
													<option>Newest</option>
													<option>Relevance</option>
													<option>Low to High</option>
													<option>High to Low</option>
													<option>Best Rated</option>
													<option>Distance</option>
													<option>Popularity</option>
												</select>
											</div>
										</li>
									</ul>
								</div>
								<div class="grid-listview">
									<ul>
										<li>
											<a href="{{ route('cars.index') }}" class="active">
												<i class="feather-grid"></i>
											</a>
										</li>
										<li>
											<a href="listing-list.html">
												<i class="feather-list"></i>
											</a>
										</li>
										<li>
											<a href="listing-map.html">
												<i class="feather-map-pin"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Sort By -->	

	<!-- Car Grid View -->
	<section class="section car-listing pt-0">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 col-sm-12 col-12 theiaStickySidebar">
					<form action="#" autocomplete="off" class="sidebar-form">
						<div class="sidebar-heading">
							<h3>What Are You Looking For</h3>
						</div>
						<div class="product-search">								
							<div class="form-custom">														
								<input type="text" class="form-control" id="member_search1" placeholder="">
								<span><img src="{{ asset('images/search.svg') }}" alt="img"></span>
							</div>
						</div>
						<div class="product-availability">								
							<h6>Availability</h6>
							<div class="status-toggle">
									<input id="mobile_notifications" class="check" type="checkbox" checked="">
								<label for="mobile_notifications" class="checktoggle">checkbox</label>
							</div>
						</div>
						<div class="accord-list">
							<div class="accordion" id="accordionMain1">
								<div class="card-header-new" id="headingOne">
									<h6 class="filter-title">
										<a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Car Brand	
											<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
										</a> 
									</h6>
								</div>
								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
									<div class="card-body-chat">
										<div class="row">
											<div class="col-md-12">
												<div id="checkBoxes1">
													<div class="selectBox-cont">
														@forelse($brands as $brand)
														<label class="custom_check w-100">
															<input type="checkbox" name="brand[]" value="{{ $brand }}" {{ in_array($brand, (array)request('brand', [])) ? 'checked' : '' }} onchange="this.form.submit()">
															<span class="checkmark"></span> {{ $brand }}
														</label>
														@empty
														<p class="text-muted">No brands available</p>
														@endforelse
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" class="d-inline-flex align-items-center justify-content-center btn w-100 btn-primary filter-btn">
							<span><i class="feather-filter me-2"></i></span>Filter results
						</button>
						<a href="#" class="reset-filter">Reset Filter</a>
					</form>
				</div>
				<div class="col-lg-9">
					<div class="row">
						@foreach($cars as $car)
						<!-- col -->
						<div class="col-xxl-4 col-lg-6 col-md-6 col-12">
							<div class="listing-item">										
								<div class="listing-img">
                                    @if($pickupDate && $returnDate)
                                        @php
                                            $status = $car->getAvailabilityStatus($pickupDate, $returnDate);
                                            $badgeClass = '';
                                            $badgeText = '';
                                            if($status === 'available') {
                                                $badgeClass = 'bg-success';
                                                $badgeText = 'Tersedia';
                                            } elseif($status === 'maintenance') {
                                                $badgeClass = 'bg-warning text-dark';
                                                $badgeText = 'Maintenance';
                                            } elseif($status === 'booked') {
                                                $badgeClass = 'bg-danger';
                                                $badgeText = 'Tidak Tersedia';
                                            }
                                        @endphp
                                        @if($badgeText)
                                            <div class="position-absolute top-0 start-0 m-3" style="z-index: 100;">
                                                <span class="badge {{ $badgeClass }} p-2">{{ $badgeText }}</span>
                                            </div>
                                        @endif
                                    @endif
									<a href="{{ route('car.details', $car->id) }}">
										@if($car->photo)
											<img src="{{ asset($car->photo) }}" class="img-fluid" alt="{{ $car->name }}" style="height: 250px; object-fit: cover; width: 100%;">
										@else
											<img src="{{ asset('images/car-01.jpg') }}" class="img-fluid" alt="{{ $car->name }}" style="height: 250px; object-fit: cover; width: 100%;">
										@endif
									</a>
									<div class="fav-item justify-content-end">
										<span class="img-count"><i class="feather-image"></i>{{ $car->images->count() + 1 }}</span>
										<a href="javascript:void(0)" class="fav-icon">
											<i class="feather-heart"></i>
										</a>										
									</div>	
									<span class="featured-text">{{ $car->brand }}</span>
								</div>										
								<div class="listing-content">
									<div class="listing-features d-flex align-items-end justify-content-between">
										<div class="list-rating">
											<h3 class="listing-title">
												<a href="{{ route('car.details', $car->id) }}">{{ $car->name }}</a>
											</h3>																	  
											<div class="list-rating">							
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<span>(5.0)</span>
											</div>
										</div>
									</div> 
									<div class="listing-details-group">
										<ul>
											<li>
												<span><img src="{{ asset('images/car-parts-01.svg') }}" alt="Auto"></span>
												<p>{{ $car->transmission }}</p>
											</li>
											<!-- <li>
												<span><img src="{{ asset('images/car-parts-02.svg') }}" alt="10 KM"></span>
												<p>{{ $car->type }}</p>
											</li> -->
											<li>
												<span><img src="{{ asset('images/car-parts-03.svg') }}" alt="Petrol"></span>
												<p>{{ $car->fuel_type }}</p>
											</li>
											<li>
												<span><img src="{{ asset('images/car-parts-06.svg') }}" alt="Persons"></span>
												<p>{{ $car->seating_capacity }}</p>
											</li>
											<li>
												<span><i class="feather-calendar me-2"></i></span>
												<p>{{ $car->year }}</p>
											</li>
										</ul>	
									</div>
									<div class="listing-location-details">
										<div class="listing-price">
											<h6>Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }} <span>/ Day</span></h6>
										</div>
										<div class="listing-button">
											<a href="{{ route('car.details', $car->id) }}" class="btn btn-order"><span><i class="feather-calendar me-2"></i></span>Rent Now</a>
										</div>	
									</div>
								</div>
							</div>	
						</div>
						<!-- /col -->
						@endforeach
					</div>
					
					<!-- Pagination -->
					<div class="col-12">
						<div class="blog-pagination">
							{{ $cars->links('pagination::bootstrap-4') }}
						</div>
					</div>
					<!-- /Pagination -->

				</div>
			</div>		
		</div>	
	</section>	
	<!-- /Car Grid View -->	
@endsection

@push('scripts')
	<!-- Rangeslider JS -->
	<script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('js/custom-rangeslider.js') }}"></script>

	<!-- Sticky Sidebar JS -->
	<script src="{{ asset('js/ResizeSensor.js') }}"></script>
	<script src="{{ asset('js/theia-sticky-sidebar.js') }}"></script>
	
	<script>
		$(window).scroll(function () {
			var sticky = $('.header-four'),
				scroll = $(window).scrollTop();
			if (scroll >= 150) sticky.addClass('header-fixed');
			else sticky.removeClass('header-fixed');
		});
	</script>
@endpush
