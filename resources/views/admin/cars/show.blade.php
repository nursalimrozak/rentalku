@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.cars.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Cars</a>
    </div>
    <div class="mb-4 pb-4 border-bottom">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>							
                <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                    <h4 class="me-2">Car ID : #{{ substr($car->id, 0, 8) }}</h4>
                    <span class="badge badge-md badge-success-transparent d-inline-flex align-items-center badge-sm">
                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($car->status) }}
                    </span>
                </div>
                <p>Created / Updated at : {{ $car->updated_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-dark btn-md d-flex align-items-center"><i class="ti ti-edit me-1"></i>Edit Car</a>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Car Details -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h5>Car Details</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg me-3">
                                @if($car->photo)
                                    <img src="{{ asset($car->photo) }}" alt="img" class="rounded">
                                @else
                                    <img src="{{ asset('admin_assets/images/car-01.jpg') }}" alt="img" class="rounded">
                                @endif
                            </span>
                            <div>
                                <h6>{{ $car->name }}</h6>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-2">{{ $car->car_type }}</p>
                                    <p class="mb-0 d-flex align-items-center"><i class="ti ti-circle-filled text-secondary fs-5 me-2"></i>{{ number_format($car->rental_rate_per_day, 0, ',', '.') }}/day</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <span class="badge badge-md bg-info-transparent">VIN : -</span>
                            <span class="badge badge-md bg-orange-transparent">Plate Number : {{ $car->license_plate }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mb-xl-0">
                <div class="card-header py-0">
                    <ul class="nav nav-tabs nav-tabs-bottom tab-dark">
                        <li class="nav-item">
                            <a class="nav-link active" href="#car-info" data-bs-toggle="tab">Car Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#car-price" data-bs-toggle="tab">Pricing & Tariff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#car-gallery" data-bs-toggle="tab">Gallery</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!-- Car Info -->
                        <div class="tab-pane fade active show" id="car-info">
                            <div class="border-bottom mb-3 pb-3">
                                <div class="row">
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Color</h6>
                                            <p class="d-inline-flex align-items-center fs-13"><i class="ti ti-square-filled text-warning me-1"></i>{{ $car->color }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Brand</h6>
                                            <p class="fs-13">{{ $car->brand }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Model</h6>
                                            <p class="fs-13">{{ $car->model }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Type</h6>
                                            <p class="fs-13">{{ $car->car_type }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Year</h6>
                                            <p class="fs-13">{{ $car->year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Plate Number</h6>
                                            <p class="fs-13">{{ $car->license_plate }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Mileage</h6>
                                            <p class="fs-13">-</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Transmission</h6>
                                            <p class="fs-13">{{ $car->transmission }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">No of Seats</h6>
                                            <p class="fs-13">{{ $car->seating_capacity }}</p>
                                        </div>
                                    </div>
                                     <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Fuel Type</h6>
                                            <p class="fs-13">{{ $car->fuel_type }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Car Info -->

                        <!-- Car Price -->
                        <div class="tab-pane fade" id="car-price">
                            <div class="border-bottom mb-3 pb-3">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                    <h6>Pricing</h6>
                                    <a href="javascript:void(0);" class="link-default"><i class="ti ti-edit"></i></a>
                                </div>
                                <div class="row">
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Per Day</h6>
                                            <p class="fs-13">{{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Weekly</h6>
                                            <p class="fs-13">{{ $car->rental_rate_per_week ? number_format($car->rental_rate_per_week, 0, ',', '.') : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Monthly</h6>
                                            <p class="fs-13">{{ $car->rental_rate_per_month ? number_format($car->rental_rate_per_month, 0, ',', '.') : '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Driver Fee (In City)</h6>
                                            <p class="fs-13">{{ number_format($car->driver_fee_in_city, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 col-sm-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Driver Fee (Out Town)</h6>
                                            <p class="fs-13">{{ number_format($car->driver_fee_out_town, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Car Price -->

                        <!-- Gallery -->
                        <div class="tab-pane fade" id="car-gallery">
                            <div class="border-bottom mb-3 pb-3">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                    <h6>Gallery</h6>
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap-3">
                                    @foreach($car->images as $image)
                                    <div class="gallery-wrap">
                                        <a href="{{ asset($image->image_path) }}" data-fancybox="gallery">
                                            <img src="{{ asset($image->image_path) }}" alt="img" style="width: 150px; height: 100px; object-fit: cover;" class="rounded">
                                        </a>
                                    </div>
                                    @endforeach
                                    @if($car->images->isEmpty())
                                        <p>No gallery images upload.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /Gallery -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /Car Details -->

        <!-- Rent Summary -->
        <div class="col-xl-4 theiaStickySidebar">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h5>Description</h5>
                    </div>
                     <p>{{ $car->description ?? 'No description available.' }}</p>
                </div>
            </div>
        </div>
        <!-- /Rent Summary -->

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('admin_assets/css/jquery.fancybox.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('admin_assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('admin_assets/js/theia-sticky-sidebar.js') }}"></script>
@endpush
