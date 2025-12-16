@extends('layouts.app')

@section('content')

		<!-- Banner -->
		<section class="banner-section-four">		
			<div class="container">
			   	<div class="home-banner">		
				   <div class="row align-items-center">					    
					   	<div class="col-lg-5" data-aos="fade-down">
							<div class="banner-content">
								@if(isset($settings['banner']))
									<h1>{{ $settings['banner']->title }}</h1>
									<p>{{ $settings['banner']->description }}</p>
								@else
									<h1>Explore our <span>Verified & Professional</span> Cars</h1>
									<p>Modern design sports cruisers for those who crave adventure & grandeur Cars for relaxing with your loved ones.</p>
								@endif

							</div>	
					   	</div>
						<div class="col-lg-7">							
							<div class="banner-image">
								<div class="banner-img" data-aos="fade-down">
									<!-- <div class="amount-icon">
										<span class="day-amt">
											<p>Mulai dari</p>
											<h6>Rp 250K <span> /hari</span></h6>
										</span>
									</div> -->
									@if(isset($settings['banner']) && $settings['banner']->image)
										<img src="{{ asset('storage/' . $settings['banner']->image) }}" class="img-fluid" alt="img">
									@else
										<img src="{{ asset('images/banner.png') }}" class="img-fluid" alt="img">
									@endif
								</div>
							</div>
						</div>
				   	</div>
			   	</div>	
				<!-- <div class="banner-search">
					   <form action="listing-grid.html" class="form-block d-flex align-items-center">
						   <div class="search-input">
							   <div class="input-block">
								   <label>Pickup Location</label>
								   <select class="select">
									   <option>Choose Location</option>
									   <option>New York</option>
									   <option>Dallas</option>
									   <option>Chicago</option>
									   <option>San Diego</option>
								   </select>
							   </div>
						   </div>
						   <div class="search-input">
							   <div class="input-block">
								   <label>Drop Location</label>
								   <select class="select">
									   <option>Choose Location</option>
									   <option>San Francisco</option>
									   <option>Austin</option>
									   <option>Boston</option>
									   <option>Chicago</option>
								   </select>
							   </div>
						   </div>
						   <div class="search-input">
							   <div class="input-block">
								   <label>Pickup Date & time</label>
								   <div class="input-wrap">
										<input type="text" class="form-control flatpickr-datetime" value="2025-03-14 12:00">
										<span class="input-icon"><i class="bx bx-chevron-down"></i></span>
								   </div>
							   </div>
						   </div>
						   <div class="search-input input-end">
							   <div class="input-block">
								   <label>Drop Date & time</label>
								   <div class="input-wrap">
										<input type="text" class="form-control flatpickr-datetime" value="2025-03-15 12:00">
										<span class="input-icon"><i class="bx bx-chevron-down"></i></span>
									</div>
							   </div>
						   </div>
						   <div class="search-btn">
							   <button class="btn btn-primary" type="submit"><i class="bx bx-search-alt"></i></button>
						   </div>
					   </form>
				   </div> -->
		   	</div>
		   	<div class="banner-bgs">
		   		<img src="images/banner-bg-01.png" class="bg-01 img-fluid" alt="img">
		   	</div>
		</section>
	   	<!-- /Banner -->


		<!-- Feature Section -->
		<section class="feature-section pt-0">
			<div class="container">	
				<div class="row align-items-center">	
					<div class="col-lg-6">	

						<div class="feature-img">
							<div class="section-heading heading-four text-start" data-aos="fade-down">
								@if(isset($settings['feature']))
									<h2>{{ $settings['feature']->title }}</h2>
									<p>{{ $settings['feature']->description }}</p>
								@else
									<h2>Best Platform for Car Rental</h2>
									<p>Why do we choose relax rent bikes generally if we travel in a un known cities with a bike in our hand we feel which is like a home town</p>
								@endif
							</div>
							@if(isset($settings['feature']) && $settings['feature']->image)
								<img src="{{ asset('storage/' . $settings['feature']->image) }}" class="img-fluid" alt="img">
							@else
								<img src="images/car.png" alt="img" class="img-fluid">
							@endif
						</div>

					</div>

					<div class="col-lg-6">	
						<div class="row row-gap-4">
							
							@forelse($features as $feature)
							<!-- Feature Item -->
							<div class="col-md-6 d-flex">
								<div class="feature-item flex-fill">
									<span class="feature-icon">
										<i class="{{ $feature->icon }}"></i>
									</span>
									<div>
										<h6 class="mb-1">{{ $feature->title }}</h6>
										<p>{{ $feature->description }}</p>
									</div>
								</div>
							</div>
							<!-- /Feature Item -->
							@empty
							<!-- Fallback Static Features -->
							<div class="col-md-6 d-flex">
								<div class="feature-item flex-fill">
									<span class="feature-icon"><i class="bx bxs-info-circle"></i></span>
									<div><h6 class="mb-1">Best Deal</h6><p>Dreams Rent offers a fleet of high-quality </p></div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="feature-item flex-fill">
									<span class="feature-icon"><i class="bx bx-exclude"></i></span>
									<div><h6 class="mb-1">Doorstep Delivery</h6><p>Dreams Rent offers a fleet of high-quality </p></div>
								</div>
							</div>
							@endforelse

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Feature Section -->

		<!-- Car Section -->
		<section class="car-section">
			<div class="container">	

				<div class="section-heading heading-four" data-aos="fade-down">
					@if(isset($settings['car']))
						<h2>{{ $settings['car']->title }}</h2>
						<p>{{ $settings['car']->description }}</p>
					@else
						<h2>Explore Most Popular Cars</h2>
						<p>Here's a list of some of the most popular cars globally</p>
					@endif
				</div>

				<div class="row">

                    @foreach($cars as $car)
					<div class="col-lg-4 col-md-6">
						<div class="listing-item listing-item-two">										
							<div class="listing-img">
                                <a href="{{ route('car.details', $car->id) }}">
                                    @if($car->photo)
                                        <img src="{{ asset($car->photo) }}" class="img-fluid" alt="{{ $car->name }}" style="width: 100%; height: 250px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="img-fluid" alt="{{ $car->name }}">
                                    @endif
                                </a>
								<div class="fav-item">
									<div class="d-flex align-items-center gap-2">
										<span class="featured-text">{{ $car->brand }}</span>
										<span class="availability">Available</span>
									</div>
									<a href="javascript:void(0)" class="fav-icon">
										<i class="feather-heart"></i>
									</a>										
								</div>									
								<span class="location"><i class="bx bx-map me-1"></i>Indonesia</span>
							</div>										
							<div class="listing-content">
								<div class="listing-features d-flex align-items-center justify-content-between">
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
											<span>(5.0) 0 Reviews</span>
										</div>
									</div>
									<div>
										<h4 class="price">Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }} <span>/ Day</span></h4>
									</div>
								</div> 
								<div class="listing-details-group">
									<ul>
										<li>
											<img src="images/car-parts-01.svg" alt="Auto">
											<p>{{ $car->transmission }}</p>
										</li>
										<li>
											<img src="images/car-parts-02.svg" alt="10 KM">
											<p>{{ $car->seating_capacity }} Seats</p>
										</li>
										<li>
											<img src="images/car-parts-03.svg" alt="Petrol">
											<p>{{ $car->fuel_type }}</p>
										</li>
										<li>
											<img src="images/car-parts-05.svg" alt="2018">
											<p>{{ $car->year }}</p>	
										</li>
									</ul>
								</div>	
							</div>
						</div>	
					</div>
                    @endforeach

				</div>

				<div class="view-all-btn text-center aos" data-aos="fade-down">
					<a href="{{ route('cars.index') }}" class="btn btn-secondary d-inline-flex align-items-center">View More Cars<i class="bx bx-right-arrow-alt ms-1"></i></a>
				</div>

			</div>
		</section>
		<!-- /Car Section -->

		<!-- Brand Section -->
		<section class="brand-section">
			<div class="container">	
				<div class="section-heading heading-four" data-aos="fade-down">
					@if(isset($settings['brand']))
						<h2 class="text-white">{{ $settings['brand']->title }}</h2>
						<p>{{ $settings['brand']->description }}</p>
					@else
						<h2 class="text-white">Rent by Brands</h2>
						<p>Here's a list of some of the most popular cars globally</p>
					@endif
				</div>
				<div class="brands-slider owl-carousel">
					@forelse($brands as $brand)
					<div class="brand-wrap">
						<img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="height: 50px; object-fit: contain;">
						<p>{{ $brand->name }}</p>
					</div>
					@empty
					<div class="brand-wrap">
						<img src="images/brand-09.svg" alt="img">
						<p>Chevrolet</p>
					</div>
					<div class="brand-wrap">
						<img src="images/brand-10.svg" alt="img">
						<p>Chevrolet</p>
					</div>
					<div class="brand-wrap">
						<img src="images/brand-11.svg" alt="img">
						<p>Chevrolet</p>
					</div>
					@endforelse
				</div>
				<div class="brand-img text-center">
					<img src="images/brand.png" alt="img" class="img-fluid">
				</div>
			</div>
		</section>
		<!-- /Brand Section -->

		<!-- Rental Section -->
		<section class="rental-section-four">
			<div class="container">	
				<div class="row align-items-center">
					<div class="col-lg-7">
						<div class="rental-img">
							@if(isset($settings['rental']) && $settings['rental']->image)
								<img src="{{ asset('storage/' . $settings['rental']->image) }}" class="img-fluid" alt="img">
							@else
								<img src="images/rent-car.png" alt="img" class="img-fluid">
							@endif
							<!-- <div class="grid-img">
								<img src="images/car-grid.png" alt="img" class="img-fluid">
							</div> -->
						</div>						
					</div>
					<div class="col-lg-5">
						<div class="rental-content">
							<div class="section-heading heading-four text-start" data-aos="fade-down">
								@if(isset($settings['rental']))
									<h2>{{ $settings['rental']->title }}</h2>
									<p>{{ $settings['rental']->description }}</p>
								@else
									<h2>Rent Our Cars in 3 Steps</h2>
									<p>Check how it Works to Rent Cars in DreamsRent</p>
								@endif
							</div>

							@php
								$bgColors = ['bg-primary', 'bg-secondary-100', 'bg-dark'];
							@endphp

							@forelse($rentalSteps as $index => $step)
							<div class="step-item d-flex align-items-center">
								<span class="step-icon {{ $bgColors[$index % 3] }} me-3">
									<i class="{{ $step->icon }}"></i>
								</span>
								<div>
									<h5>{{ $step->title }}</h5>
									<p>{{ $step->description }}</p>
								</div>
							</div>
							@empty
							<!-- Fallback Static Steps if No Data -->
							<div class="step-item d-flex align-items-center">
								<span class="step-icon bg-primary me-3">
									<i class="bi bi-calendar-heart"></i>
								</span>
								<div>
									<h5>Choose Date &  Locations</h5>
									<p>Determine the date & location for your car rental. Consider factors such as your travel itinerary, pickup/drop-off locations</p>
								</div>
							</div>
							<div class="step-item d-flex align-items-center">
								<span class="step-icon bg-secondary-100 me-3">
									<i class="bi bi-geo-alt-fill"></i>
								</span>
								<div>
									<h5>Select Pick-Up & Drop Locations</h5>
									<p>Check the availability of your desired vehicle type for your chosen dates and location. Ensure that the rental rates, taxes, fees, and any additional charges.</p>
								</div>
							</div>
							<div class="step-item d-flex align-items-center">
								<span class="step-icon bg-dark me-3">
									<i class="bi bi-car-front-fill"></i>
								</span>
								<div>
									<h5>Book your Car</h5>
									<p>Determine the date & location for your car rental. Consider factors such as your travel itinerary, pickup/drop-off locations</p>
								</div>
							</div>
							@endforelse
						</div>
					</div>
				</div>
				<div class="count-sec">
					<div class="row row-gap-4">
						<div class="col-lg-3 col-md-6 d-flex">
							<div class="count-item flex-fill">
								<h3><span class="counterUp">16</span>K+</h3>
								<p>Happy Customers</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 d-flex">
							<div class="count-item flex-fill">
								<h3><span class="counterUp">2547</span>K+</h3>
								<p>Count of Cars</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 d-flex">
							<div class="count-item flex-fill">
								<h3><span class="counterUp">625</span>K+</h3>
								<p>Locations to Pickup</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 d-flex">
							<div class="count-item flex-fill">
								<h3><span class="counterUp">15000</span>K+</h3>
								<p>Total Kilometers</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Rental Section -->

		<!-- Testimonial Section -->
		<section class="testimonial-section">
			<div class="container">	
				<div class="section-heading heading-four" data-aos="fade-down">
					@if(isset($settings['testimonial']))
						<h2>{{ $settings['testimonial']->title }}</h2>
						<p>{{ $settings['testimonial']->description }}</p>
					@else
						<h2>Our Clients Feedback</h2>
						<p>Provided by customers about their experience with a product or service.</p>
					@endif
				</div>

				<div class="row row-gap-4 justify-content-center">
					@forelse($testimonials as $testimonial)
					<!-- Testimonial Item -->
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="testimonial-item testimonial-item-two flex-fill">
							<div class="user-img">
								@if($testimonial->photo)
									<img src="{{ asset('storage/' . $testimonial->photo) }}" class="img-fluid" alt="{{ $testimonial->name }}">
								@else
									<img src="images/avatar-02.jpg" class="img-fluid" alt="img">
								@endif
							</div>
							<p>{{ Str::limit($testimonial->content, 100) }}</p>							
							<div class="rating">
								@for($i = 0; $i < $testimonial->rating; $i++)
									<i class="fas fa-star filled"></i>
								@endfor
								@for($i = $testimonial->rating; $i < 5; $i++)
									<i class="fas fa-star"></i>
								@endfor
							</div>
							<div class="user-info">
								<h6>{{ $testimonial->name }}</h6>
								<p>{{ $testimonial->location }}</p>												
							</div>
						</div>
					</div>
					<!-- /Testimonial Item -->
					@empty
					<!-- Fallback Static Testimonial -->
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="testimonial-item testimonial-item-two flex-fill">
							<div class="user-img">
								<img src="images/avatar-02.jpg" class="img-fluid" alt="img">
							</div>
							<p>Renting a car from Dreams rent made my vacation so much smoother! The process was quick</p>							
							<div class="rating">
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
							</div>
							<div class="user-info">
								<h6>Kyle Roberts DVM</h6>
								<p>Newyork, USA</p>												
							</div>
						</div>
					</div>
					@endforelse

				</div>

				<div class="view-all-btn text-center aos" data-aos="fade-down">
					<a href="{{ route('cars.index') }}" class="btn btn-secondary">View All<i class="bx bx-right-arrow-alt ms-1"></i></a>
				</div>

				<div class="client-slider owl-carousel">
					@forelse($rentalCommunities as $community)
					<div class="p-2">
						<img src="{{ asset('storage/' . $community->image) }}" alt="img" style="height: 100px; object-fit: cover; border-radius: 10px;">
					</div>
					@empty
					<div>
						<img src="images/client-01.svg" alt="img">
					</div>
					<div>
						<img src="images/client-02.svg" alt="img">
					</div>
					<div>
						<img src="images/client-03.svg" alt="img">
					</div>
					<div>
						<img src="images/client-04.svg" alt="img">
					</div>
					@endforelse
				</div>
			</div>
		</section>
		<!-- /Testimonial Section -->	

		<!-- Blog Section -->
		<section class="blog-section-four">
			<div class="container">	
				<div class="section-heading heading-four" data-aos="fade-down">
					@if(isset($settings['article']))
						<h2>{{ $settings['article']->title }}</h2>
						<p>{{ $settings['article']->description }}</p>
					@else
						<h2>Insights and Innovations</h2>
						<p>Dive into our articles to stay ahead in the fast-paced world of technology.</p>
					@endif
				</div>

				<div class="row row-gap-3 justify-content-center">
					@forelse($articles as $article)
					<!-- Blog Item -->
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="blog-item flex-fill">
							<div class="blog-img">
								<a href="javascript:void(0);">
									<img src="{{ asset('storage/' . $article->image) }}" class="img-fluid" alt="img" style="width: 100%; height: 250px; object-fit: cover;">
								</a>
							</div>
							<div class="blog-content">
								<div class="d-flex align-center justify-content-between blog-category">
									<a href="javascript:void(0);" class="category">{{ $article->category }}</a>
									<p class="date d-inline-flex align-center"><i class="bx bx-calendar me-1"></i>{{ $article->published_at ? $article->published_at->format('F d, Y') : '' }}</p>
								</div>
								<h5 class="title"><a href="javascript:void(0);">{{ $article->title }}</a></h5>
							</div>
						</div>
					</div>
					<!-- /Blog Item -->
					@empty
					<!-- Fallback Static Blog -->
					<div class="col-lg-4 col-md-6 d-flex">
						<div class="blog-item flex-fill">
							<div class="blog-img">
								<img src="images/blog-11.jpg" class="img-fluid" alt="img">
							</div>
							<div class="blog-content">
								<div class="d-flex align-center justify-content-between blog-category">
									<a href="javascript:void(0);" class="category">Journey</a>
									<p class="date d-inline-flex align-center"><i class="bx bx-calendar me-1"></i>October 6, 2022</p>
								</div>
								<h5 class="title"><a href="blog-details.html">The 2025 Ford F-150 Raptor – A First Look you need to know</a></h5>
							</div>
						</div>
					</div>
					@endforelse

				</div>

				<div class="view-all-btn text-center aos" data-aos="fade-down">
					<a href="blog-grid.html" class="btn btn-secondary d-inline-flex align-center">View More<i class="bi bi-arrow-right ms-1"></i></a>
				</div>	

			</div>
		</section>
		<!-- /Blog Section -->

		<!-- FAQ Section -->
		<section class="faq-section-four pt-0">
			<div class="container">	
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="section-heading heading-four" data-aos="fade-down">
							@if(isset($settings['faq']))
								<h2>{{ $settings['faq']->title }}</h2>
								<p>{{ $settings['faq']->description }}</p>
							@else
								<h2>Frequently asked questions</h2>
								<p>Explore to learn more about how can empower your business</p>
							@endif
						</div>				
						<div class="accordion faq-accordion" id="faqAccordion">
							@forelse($faqs as $index => $faq)
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="faq{{ $faq->id }}">
										{{ $faq->question }}
									</button>
								</h2>
								<div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
									<div class="accordion-body">
										<p>{{ $faq->answer }}</p>
									</div>
								</div>
							</div>
							@empty
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
										How old do I need to be to rent a car?
									</button>
								</h2>
								<div id="faqOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
									<div class="accordion-body">
										<p>You can browse our selection online or contact us for assistance in choosing the right vehicle for you</p>
									</div>
								</div>
							</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /FAQ Section -->

@endsection