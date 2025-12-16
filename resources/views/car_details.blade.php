@extends('layouts.app')
@section('header-class', 'header-one')

@section('content')
    @push('styles')
    <style>
        /* Main Slider Image Fix */
        .detail-bigimg .product-img img {
            width: 100%;
            height: 450px; /* Fixed height for consistency */
            object-fit: cover; /* Crop to fit without distortion */
            border-radius: 6px;
        }

        /* Thumbnail Slider Image Fix */
        .slider-nav-thumbnails .slick-slide {
            padding: 0 5px; /* Spacing between thumbnails */
        }

        .slider-nav-thumbnails .slick-slide img {
            width: 100%;
            height: 100px; /* Fixed height for thumbnails */
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            opacity: 0.7;
            transition: all 0.3s;
        }

        .slider-nav-thumbnails .slick-slide.slick-current img {
            opacity: 1;
            border: 2px solid #FF9F00; /* Active highlight */
        }
    </style>
    @endpush
    <!-- Breadscrumb Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">{{ $car->name }}</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Listings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $car->name }}</li>
                        </ol>
                    </nav>							
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadscrumb Section -->
    
    <!-- Detail Page Head-->
    <section class="product-detail-head">
        <div class="container">
            <div class="detail-page-head">
                <div class="detail-headings">
                    <div class="star-rated">
                        <ul class="list-rating">
                            <li>
                                <div class="car-brand">
                                    <span>
                                        <img src="{{ asset('images/car-icon.svg') }}" alt="img">
                                    </span>
                                    {{ $car->type }}
                                </div>
                            </li>
                            <li>
                            <span class="year">{{ $car->year }}</span>
                        </li>
                        <li class="ratings">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <span class="d-inline-block average-list-rating">(5.0)</span>
                        </li>
                        </ul>
                        <div class="camaro-info">
                            <h3>{{ $car->name }}</h3>
                            <div class="camaro-location">
                                <div class="camaro-location-inner">
                                    <i class="bx bx-map"></i>                                        
                                    <span>Brand : {{ $car->brand }} </span> 
                                </div>
                                <div class="camaro-location-inner">    
                                    <i class="bx bx-show"></i>                                     
                                    <span>Type : {{ $car->model }} </span>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="details-btn">
                    <span class="total-badge"><i class="bx bx-calendar-edit"></i>Price : Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }} / Day</span>
                    <a href="#"> <i class="bx bx-share-alt"></i>Share</a>
                </div>				  
            </div>
        </div>
    </section>
    <!-- /Detail Page Head-->

    <section class="section product-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="detail-product">
                        <div class="pro-info">
                            <div class="pro-badge">
                                <span class="badge-km"><i class="fa-solid fa-person-walking"></i>Status: Available</span>
                                <a href="javascript:void(0);" class="fav-icon"><i class="fa-regular fa-heart"></i></a>
                            </div>
                            <ul>
                                <li class="del-airport"><i class="fa-solid fa-check"></i>Airport delivery</li>
                                <li class="del-home"><i class="fa-solid fa-check"></i>Home delivery</li>
                            </ul>
                        </div>
                        <div class="product-img-slider">
                            <div class="slider detail-bigimg">
                                <div class="product-img">
                                    @if($car->photo)
                                        <img src="{{ asset($car->photo) }}" alt="{{ $car->name }}">
                                    @else
                                        <img src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="{{ $car->name }}">
                                    @endif
                                </div>
                                @foreach($car->images as $image)
                                <div class="product-img">
                                    <img src="{{ asset($image->image_path) }}" alt="Slider">
                                </div>
                                @endforeach
                            </div>
                            <div class="slider slider-nav-thumbnails">
                                <div>
                                    @if($car->photo)
                                        <img src="{{ asset($car->photo) }}" alt="{{ $car->name }}">
                                    @else
                                        <img src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="{{ $car->name }}">
                                    @endif
                                </div>
                                @foreach($car->images as $image)
                                <div><img src="{{ asset($image->image_path) }}" alt="product image"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Listing Section -->
                    <div class="review-sec mb-0">
                        <div class="review-header">
                            <h4>Description of Listing</h4>
                        </div>
                        <div class="description-list">
                            <p>{{ $car->description }}</p>
                        </div>
                    </div>
                    <!-- /Listing Section -->

                    <!-- Specifications -->
                    <div class="review-sec specification-card ">
                        <div class="review-header">
                            <h4>Specifications</h4>
                        </div>
                        <div class="card-body">
                        <div class="lisiting-featues">
                            <div class="row">
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-1.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Body </span>
                                        <h6>{{ $car->type }}</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-2.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Brand </span>
                                        <h6>{{ $car->brand }}</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-3.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Transmission </span>
                                        <h6>{{ $car->transmission }}</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-4.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Fuel Type </span>
                                        <h6>{{ $car->fuel_type }}</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-7.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Year</span>
                                        <h6>{{ $car->year }}</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-10.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Door </span>
                                        <h6>{{ $car->doors }} Doors</h6>
                                    </div>
                                </div>
                                <div class="featureslist d-flex align-items-center col-xl-3 col-md-4 col-sm-6">
                                    <div class="feature-img">
                                        <img src="{{ asset('images/specification-icon-6.svg') }}" alt="Icon">
                                    </div>
                                    <div class="featues-info">
                                        <span>Capacity </span>
                                        <h6>{{ $car->seating_capacity }} Persons</h6>
                                    </div>
                                </div>
                                </div>
                            </div>	
                        </div>	
                    </div>	
                    <!-- Specifications -->	

                    <!-- FAQ -->	
                    <div class="review-sec faq-feature">
                        <div class="review-header">
                            <h4>FAQ’s</h4>
                        </div>
                        <div class="faq-info">
                            <div class="faq-card">
                                <h4 class="faq-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#faqOne" aria-expanded="false">How old do I need to be to rent a car?</a>
                                </h4>
                                <div id="faqOne" class="card-collapse collapse">
                                    <p>We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles. You can browse our selection online or contact us for assistance in choosing the right vehicle for you</p>
                                </div>
                            </div>	
                            <div class="faq-card">
                                <h4 class="faq-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#faqTwo" aria-expanded="false">What documents do I need to rent a car?</a>
                                </h4>
                                <div id="faqTwo" class="card-collapse collapse">
                                    <p>We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles. You can browse our selection online or contact us for assistance in choosing the right vehicle for you</p>
                                </div>
                            </div>
                            <div class="faq-card">
                                <h4 class="faq-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#faqThree" aria-expanded="false">What types of vehicles are available for rent?</a>
                                </h4>
                                <div id="faqThree" class="card-collapse collapse">
                                    <p>We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles. You can browse our selection online or contact us for assistance in choosing the right vehicle for you</p>
                                </div>
                            </div>	
                            <div class="faq-card">
                                <h4 class="faq-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#faqFour" aria-expanded="false">Can I rent a car with a debit card?</a>
                                </h4>
                                <div id="faqFour" class="card-collapse collapse">
                                    <p>We offer a diverse fleet of vehicles to suit every need, including compact cars, sedans, SUVs and luxury vehicles. You can browse our selection online or contact us for assistance in choosing the right vehicle for you</p>
                                </div>
                            </div>													
                        </div>	
                    </div>
                    <!-- /FAQ -->	

                    <!-- Policies -->	
                    <div class="review-sec">
                        <div class="review-header">
                            <h4>Policies</h4>
                        </div>
                        <div class="policy-list">
                            <div class="policy-item">
                                <div class="policy-info">
                                    <h6>Cancellation Charges</h6>
                                    <p>Cancellation charges will be applied as per the policy</p>
                                </div>
                                <a href="#">Know More</a>
                            </div>
                            <div class="policy-item">
                                <div class="policy-info">
                                    <h6>Policy</h6>
                                    <p>I hereby agree to the terms and conditions of the Lease Agreement with Host</p>
                                </div>
                                <a href="#">View Details</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Policies -->

                </div>
                <div class="col-lg-4 theiaStickySidebar">
                    <div class="review-sec mt-0">
                        <div class="review-header">
                            <h4>Book This Car</h4>
                        </div>
                        <form action="{{ route('public.bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <div class="mb-3">
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="rental_type" value="daily" checked>
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Daily</span>
                                        <span class="price-rate">Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</span>		
                                    </span>			
                                </label>
                            </div>
                            
                            @if($car->rental_rate_per_week > 0)
                            <div class="mb-3">
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="rental_type" value="weekly">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Weekly</span>
                                        <span class="price-rate">Rp {{ number_format($car->rental_rate_per_week, 0, ',', '.') }}</span>		
                                    </span>			
                                </label>
                            </div>
                            @endif

                            @if($car->rental_rate_per_month > 0)
                            <div class="mb-3">
                                <label class="booking_custom_check bookin-check-2">
                                    <input type="radio" name="rental_type" value="monthly">
                                    <span class="booking_checkmark">
                                        <span class="checked-title">Monthly</span>
                                        <span class="price-rate">Rp {{ number_format($car->rental_rate_per_month, 0, ',', '.') }}</span>		
                                    </span>			
                                </label>
                            </div>
                            @endif

                            <div class="location-content">
                                @auth
                                    @if(auth()->user()->is_verified)
                                        <hr>
                                        <!-- Dates & Times -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-block mb-3">
                                                    <label>Start Date</label>
                                                    <div class="group-img">
                                                        <div class="form-wrap">
                                                            <input type="date" name="start_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-block">
                                                    <label>Start Time</label>
                                                    <div class="group-img">
                                                        <div class="form-wrap">
                                                            <input type="time" name="start_time" class="form-control" required>
                                                            <span class="form-icon" style="pointer-events: none;">
                                                                <i class="fa-regular fa-clock"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-block mb-3">
                                                    <label>End Date</label>
                                                    <div class="group-img">
                                                        <div class="form-wrap">
                                                            <input type="date" name="end_date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-block">
                                                    <label>End Time</label>
                                                    <div class="group-img">
                                                        <div class="form-wrap">
                                                            <input type="time" name="end_time" class="form-control" required>
                                                            <span class="form-icon" style="pointer-events: none;">
                                                                <i class="fa-regular fa-clock"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Service Type -->
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Service Type</label>
                                            <div class="d-flex gap-3">
                                                <label class="booking_custom_check">
                                                    <input type="radio" name="service_type" value="delivery" checked id="service_delivery">
                                                    <span class="booking_checkmark">
                                                        <span class="checked-title">Delivery</span>
                                                    </span>							
                                                </label>
                                                <label class="booking_custom_check">
                                                    <input type="radio" name="service_type" value="self_pickup" id="service_pickup">
                                                    <span class="booking_checkmark">
                                                        <span class="checked-title">Self Pickup</span>
                                                    </span>							
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Delivery Address (Show/Hide based on service type) -->
                                        <div class="input-block" id="delivery_address_div">
                                            <label>Delivery Location</label>
                                            <div class="group-img">
                                                <div class="form-wrap">
                                                    <input type="text" name="delivery_address" class="form-control" placeholder="Enter delivery address">
                                                    <span class="form-icon"><i class="fa-solid fa-location-dot"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Driver Option -->
                                        <div class="input-block mb-3">
                                            <label class="custom_check d-inline-flex">
                                                <span>Use Driver (+ Rp {{ number_format($car->driver_fee_in_city ?? 150000, 0, ',', '.') }}/day)</span>
                                                <input type="checkbox" name="use_driver" value="1">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                        <!-- Passengers -->
                                        <div class="input-block">
                                            <label>Passengers</label>
                                            <div class="group-img">
                                                <div class="form-wrap">
                                                    <input type="number" name="passengers" class="form-control" min="1" max="{{ $car->seating_capacity }}" value="1">
                                                    <span class="form-icon"><i class="fa-solid fa-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Voucher Code -->
                                        <div class="input-block mb-3">
                                            <label>Voucher Code</label>
                                            <div class="input-group">
                                                <input type="text" id="voucher_code" name="voucher_code" class="form-control" placeholder="Enter voucher code (optional)">
                                                <button type="button" class="btn btn-secondary" id="check-voucher-btn">Check</button>
                                            </div>
                                            <small id="voucher-message" class="text-danger"></small>
                                        </div>

                                        <!-- Payment Type -->
                                        <div class="mb-3">
                                            <label class="form-label">Payment Preference</label>
                                            <select class="form-select" name="payment_type">
                                                <option value="full_payment">Full Payment</option>
                                                <option value="down_payment">Down Payment (50%)</option>
                                            </select>
                                        </div>

                                        <div class="input-block mb-0 mt-3">
                                            <div class="search-btn">
                                                <button type="submit" class="btn btn-primary check-available w-100">Book Now</button>
                                            </div>
                                        </div>
                                        
                                        @if($errors->any())
                                            <div class="alert alert-danger mt-3">
                                                <ul class="mb-0">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    @else
                                        <div class="p-4 bg-light rounded text-center">
                                            <div class="mb-3">
                                                <span class="avatar avatar-xl rounded-circle bg-warning text-white">
                                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                                </span>
                                            </div>
                                            <h5>Account Not Verified</h5>
                                            <p class="text-muted mb-3">You need to verify your account by uploading your KTP and SIM before you can book a vehicle.</p>
                                            <a href="{{ route('profile.settings') }}" class="btn btn-primary w-100">
                                                Verify Account
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="p-4 bg-light rounded text-center">
                                        <div class="mb-3">
                                            <span class="avatar avatar-xl rounded-circle bg-primary text-white">
                                                <i class="fas fa-lock fa-2x"></i>
                                            </span>
                                        </div>
                                        <h5>Login Required</h5>
                                        <p class="text-muted mb-3">Please login or register to book this vehicle.</p>
                                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Login</a>
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Register</a>
                                    </div>
                                @endauth
                            </div>	
                        </form>
                    </div>
                    
                    <div class="review-sec share-car mt-0 mb-0">
                        <div class="review-header">
                            <h4>Share</h4>
                        </div>
                        <ul class="nav-social">
                            <li>
                                <a href="javascript:void(0)"><i class="fa-brands fa-facebook-f fa-facebook fi-icon"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fab fa-instagram fi-icon"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fab fa-behance fi-icon"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fa-brands fa-pinterest-p fi-icon"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fab fa-twitter fi-icon"></i> </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="fab fa-linkedin fi-icon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">               
                <div class="col-md-12">
                    <div class="details-car-grid">
                        <div class="details-slider-heading">
                            <h3>You May be Interested in</h3>
                        </div>
                        <div class="owl-carousel rental-deal-slider details-car owl-theme">
                            <!-- Static related cars for now, can be made dynamic later -->
                            @foreach(\App\Models\Car::where('id', '!=', $car->id)->limit(6)->get() as $relatedCar)
                                <div class="rental-car-item">
                                    <div class="listing-item pb-0">											
                                        <div class="listing-img">
                                            <a href="{{ route('car.details', $relatedCar->id) }}">
                                                @if($relatedCar->photo)
                                                    <img src="{{ asset($relatedCar->photo) }}" class="img-fluid" alt="{{ $relatedCar->name }}" style="height: 200px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="img-fluid" alt="{{ $relatedCar->name }}">
                                                @endif
                                            </a>
                                            <div class="fav-item justify-content-end">
                                                <a href="javascript:void(0)" class="fav-icon">
                                                    <i class="feather-heart"></i>
                                                </a>										
                                            </div>	
                                            <span class="featured-text">{{ $relatedCar->brand }}</span>
                                        </div>										
                                        <div class="listing-content">
                                            <div class="listing-features d-flex align-items-end justify-content-between">
                                                <div class="list-rating">
                                                    <h3 class="listing-title">
                                                        <a href="{{ route('car.details', $relatedCar->id) }}">{{ $relatedCar->name }}</a>
                                                    </h3>																	  
                                                    <div class="list-rating">							
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(4.0)</span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="listing-location-details">
                                                <div class="listing-price">
                                                    <h6>Rp {{ number_format($relatedCar->rental_rate_per_day, 0, ',', '.') }} <span>/ Day</span></h6>
                                                </div>
                                            </div>
                                            <div class="listing-button">
                                                <a href="{{ route('car.details', $relatedCar->id) }}" class="btn btn-order"><span><i class="feather-calendar me-2"></i></span>Rent Now</a>
                                            </div>	
                                        </div>
                                    </div>	
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
    $(document).ready(function() {
        const checkBtn = $('#check-voucher-btn');
        const voucherInput = $('#voucher_code');
        const messageSpan = $('#voucher-message');
        const bookBtn = $('button[type="submit"]'); // Assuming the submit button is the only one or identifiable
        
        // Disable book button initially if voucher has value but not verified? 
        // Logic: specific request "kalau tidak valid tombol book now itu disable". 
        // Implies: if input is empty -> enabled (optional). If input has text -> disabled until verified valid.

        function validateVoucherState() {
            if (voucherInput.val().trim() !== '' && !voucherInput.data('valid')) {
                bookBtn.prop('disabled', true);
            } else {
                bookBtn.prop('disabled', false);
            }
        }

        voucherInput.on('input', function() {
            $(this).data('valid', false);
            messageSpan.text('');
            validateVoucherState();
        });

        checkBtn.on('click', function() {
            const code = voucherInput.val().trim();
            if (!code) return;

            // Calculate estimated price for validation
            // We need start_date, end_date, start_time, end_time
            const startDate = $('input[name="start_date"]').val();
            const endDate = $('input[name="end_date"]').val();
            const startTime = $('input[name="start_time"]').val();
            const endTime = $('input[name="end_time"]').val();

            if (!startDate || !endDate || !startTime || !endTime) {
                messageSpan.text('Please select dates and times first.').removeClass('text-success').addClass('text-danger');
                return;
            }

            const start = new Date(startDate + 'T' + startTime);
            const end = new Date(endDate + 'T' + endTime);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            
            // Base Logic from Controller (Simplified)
            // Note: PHP uses Carbon diffInHours / 24 ceil. JS should match.
            // But getting exact rate from PHP variable requires blade echo.
            const ratePerDay = {{ $car->rental_rate_per_day }};
            const driverFee = {{ $car->driver_fee_in_city ?? 150000 }};
            const useDriver = $('input[name="use_driver"]').is(':checked');

            let total = ratePerDay * diffDays;
            if (useDriver) {
                total += driverFee * diffDays;
            }

            $.ajax({
                url: "{{ route('vouchers.check') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    voucher_code: code,
                    car_id: "{{ $car->id }}",
                    total_price: total
                },
                success: function(response) {
                    if (response.valid) {
                        messageSpan.text(response.message).removeClass('text-danger').addClass('text-success');
                        voucherInput.data('valid', true);
                    } else {
                        messageSpan.text(response.message).removeClass('text-success').addClass('text-danger');
                        voucherInput.data('valid', false);
                    }
                    validateVoucherState();
                },
                error: function() {
                    messageSpan.text('Error verifying voucher.').removeClass('text-success').addClass('text-danger');
                    voucherInput.data('valid', false);
                    validateVoucherState();
                }
            });
        });
    });
</script>
@endpush
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle Delivery Address
        function toggleDeliveryAddress() {
            if ($('#service_delivery').is(':checked')) {
                $('#delivery_address_div').show();
            } else {
                $('#delivery_address_div').hide();
            }
        }

        $('input[name="service_type"]').on('change', function() {
            toggleDeliveryAddress();
        });

        // Initialize on load
        toggleDeliveryAddress();

        if ($('.detail-bigimg').length > 0) {
            $('.detail-bigimg').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.slider-nav-thumbnails'
            });
        }

        if ($('.slider-nav-thumbnails').length > 0) {
            $('.slider-nav-thumbnails').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.detail-bigimg',
                dots: false,
                arrows: false,
                centerMode: false,
                focusOnSelect: true
            });
        }
    });
</script>
@endpush
