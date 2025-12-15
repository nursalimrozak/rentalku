@extends('layouts.app')
@section('header-class', 'header-one')

@section('content')
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
                            <h4>Pricing</h4>
                        </div>
                        <div class="mb-3">
                            <label class="booking_custom_check bookin-check-2">
                                <input type="radio" name="price_rate" checked="">
                                <span class="booking_checkmark">
                                    <span class="checked-title">Daily</span>
                                    <span class="price-rate">Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</span>		
                                </span>			
                            </label>
                        </div>
                        
                        @if($car->rental_rate_per_week > 0)
                        <div class="mb-3">
                            <label class="booking_custom_check bookin-check-2">
                                <input type="radio" name="price_rate">
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
                                <input type="radio" name="price_rate">
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
                                    <div class="delivery-tab">	
                                        <ul class="nav">
                                            <li>
                                                <label class="booking_custom_check">
                                                    <input type="radio" name="rent_type" checked="">
                                                    <span class="booking_checkmark">
                                                        <span class="checked-title">Delivery</span>
                                                    </span>							
                                                </label>
                                            </li>
                                            <li>
                                                <label class="booking_custom_check">
                                                    <input type="radio" name="rent_type">
                                                    <span class="booking_checkmark">
                                                        <span class="checked-title">Self Pickup</span>
                                                    </span>							
                                                </label>
                                            </li>
                                        </ul>	
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="delivery">
                                            <form class="">
                                                <ul>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label>Delivery Location</label>
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" class="form-control" placeholder="45, 4th Avanue  Mark Street USA">
                                                                    <span class="form-icon">
                                                                        <i class="fa-solid fa-location-crosshairs"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label class="custom_check d-inline-flex location-check m-0"><span>Return to same location</span>
                                                                <input type="checkbox" name="remeber">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label>Return Location</label>										
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" class="form-control" placeholder="78, 10th street Laplace USA">
                                                                    <span class="form-icon">
                                                                        <i class="fa-solid fa-location-crosshairs"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">						
                                                        <div class="input-block m-0">	
                                                            <label>Pickup Date</label>
                                                        </div>
                                                        <div class="input-block-wrapp sidebar-form">
                                                            <div class="input-block  me-lg-2">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control datetimepicker" placeholder="04/11/2023">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-calendar-days"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-block">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control timepicker" placeholder="11:00 AM">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </li>
                                                    <li class="column-group-main">						
                                                        <div class="input-block m-0">		                                       		<label>Return Date</label>
                                                        </div>
                                                        <div class="input-block-wrapp sidebar-form">
                                                            <div class="input-block me-lg-2">												
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control datetimepicker" placeholder="04/11/2023">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-calendar-days"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-block">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control timepicker" placeholder="11:00 AM">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </li>
                                                    <li class="column-group-last">
                                                        <div class="input-block mb-0">
                                                            <div class="search-btn">
                                                                <a href="booking-checkout.html" class="btn btn-primary check-available w-100">Book</a>
                                                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#enquiry" class="btn btn-theme">Enquire Us</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>	
                                        </div>
                                        <div class="tab-pane fade" id="pickup">
                                            <form class="">
                                                <ul>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label>Delivery Location</label>
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <select class="select">
                                                                        <option>Newyork Office - 78, 10th street Laplace USA</option>
                                                                        <option>Newyork Office - 12, 5th street USA</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label class="custom_check d-inline-flex location-check m-0"><span>Return to same location</span>
                                                                <input type="checkbox" name="remeber">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label>Delivery Location</label>
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <select class="select">
                                                                        <option>Newyork Office - 78, 10th street Laplace USA</option>
                                                                        <option>Newyork Office - 12, 5th street USA</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">
                                                        <div class="input-block">
                                                            <label>Return Location</label>										
                                                            <div class="group-img">
                                                                <div class="form-wrap">
                                                                    <input type="text" class="form-control" placeholder="78, 10th street Laplace USA">
                                                                    <span class="form-icon">
                                                                        <i class="fa-solid fa-location-crosshairs"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="column-group-main">						
                                                        <div class="input-block m-0">	
                                                            <label>Pickup Date</label>
                                                        </div>
                                                        <div class="input-block-wrapp sidebar-form">
                                                            <div class="input-block  me-lg-2">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control datetimepicker" placeholder="04/11/2023">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-calendar-days"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-block">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control timepicker" placeholder="11:00 AM">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </li>
                                                    <li class="column-group-main">						
                                                        <div class="input-block m-0">		                                       		<label>Return Date</label>
                                                        </div>
                                                        <div class="input-block-wrapp sidebar-form">
                                                            <div class="input-block me-2">												
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control datetimepicker" placeholder="04/11/2023">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-calendar-days"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="input-block">											
                                                                <div class="group-img">
                                                                    <div class="form-wrap">
                                                                        <input type="text" class="form-control timepicker" placeholder="11:00 AM">
                                                                        <span class="form-icon">
                                                                            <i class="fa-regular fa-clock"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </li>
                                                    <li class="column-group-last">
                                                        <div class="input-block mb-0">
                                                            <div class="search-btn">
                                                                <a href="booking-checkout.html" class="btn btn-primary check-available w-100">Book</a>
                                                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#enquiry" class="btn btn-theme">Enquire Us</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>	
                                        </div>
                                    </div>
                                @else
                                    <div class="p-4 bg-light rounded text-center">
                                        <div class="mb-3">
                                            <span class="avatar avatar-xl rounded-circle bg-warning text-white">
                                                <i class="ti ti-alert-circle fs-1"></i>
                                            </span>
                                        </div>
                                        <h5>Account Not Verified</h5>
                                        <p class="text-muted mb-3">You need to verify your account by uploading your KTP and SIM before you can book a vehicle.</p>
                                        <a href="{{ route('profile.settings') }}" class="btn btn-primary w-100">
                                            <i class="ti ti-user-check me-2"></i>Verify Account
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="p-4 bg-light rounded text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl rounded-circle bg-primary text-white">
                                            <i class="ti ti-lock fs-1"></i>
                                        </span>
                                    </div>
                                    <h5>Login Required</h5>
                                    <p class="text-muted mb-3">Please login or register to book this vehicle.</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Register</a>
                                </div>
                            @endauth
                        </div>	
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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
