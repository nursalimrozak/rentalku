@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.drivers.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>All Drivers</a>
    </div>
    <div class="mb-4 pb-4 border-bottom">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>							
                <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                    <h4 class="me-2">Driver : {{ $driver->name }}</h4>
                    <span class="badge badge-md {{ $driver->status == 'available' ? 'badge-soft-success' : 'badge-soft-danger' }} d-inline-flex align-items-center badge-sm">
                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($driver->status) }}
                    </span>
                </div>
                <!-- <p>Joined at : {{ $driver->created_at->format('d M Y, h:i A') }}</p> -->
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-dark btn-md d-flex align-items-center"><i class="ti ti-edit me-1"></i>Edit Driver</a>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Sidebar / Driver Profile -->
        <div class="col-xl-4 theiaStickySidebar">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h5>Driver Profile</h5>
                    </div>
                    <div class="text-center">
                        <span class="avatar avatar-xxl mb-3">
                            @if($driver->photo)
                                <img src="{{ asset($driver->photo) }}" alt="img" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <img src="{{ asset('admin_assets/images/profile-placeholder.jpg') }}" alt="img" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                            @endif
                        </span>
                        <h6 class="mb-2">{{ $driver->name }}</h6>
                        <p class="mb-2"><i class="ti ti-phone me-1"></i>{{ $driver->phone_number }}</p>
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <span class="badge badge-soft-warning"><i class="ti ti-star-filled me-1"></i>{{ $driver->rating ?? '0.0' }}</span>
                            <span class="badge badge-soft-info"><i class="ti ti-briefcase me-1"></i>{{ $driver->experience_years }} Yrs Exp</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Info / Status if needed -->
             <div class="card">
                <div class="card-body">
                    <div class="border-bottom mb-3 pb-3">
                        <h5>Status</h5>
                    </div>
                     <div class="d-flex align-items-center justify-content-between">
                        <span>Current Status</span>
                        <span class="badge badge-md {{ $driver->status == 'available' ? 'badge-soft-success' : 'badge-soft-danger' }} d-inline-flex align-items-center badge-sm">
                            <i class="ti ti-point-filled me-1"></i>{{ ucfirst($driver->status) }}
                        </span>
                     </div>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Driver Details / Tabs -->
        <div class="col-xl-8">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header py-0">
                    <ul class="nav nav-tabs nav-tabs-bottom tab-dark">
                        <li class="nav-item">
                            <a class="nav-link active" href="#driver-info" data-bs-toggle="tab">Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#driver-price" data-bs-toggle="tab">Rates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#driver-docs" data-bs-toggle="tab">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!-- Driver Info -->
                        <div class="tab-pane fade active show" id="driver-info">
                            <div class="border-bottom mb-3 pb-3">
                                <h6 class="mb-3">Personal Information</h6>
                                <div class="row">
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Gender</h6>
                                            <p class="fs-13">{{ ucfirst($driver->gender) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Date of Birth</h6>
                                            <p class="fs-13">{{ $driver->date_of_birth ? $driver->date_of_birth->format('d M Y') : '-' }} ({{ $driver->age }} Years Old)</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Bio</h6>
                                            <p class="fs-13">{{ $driver->bio ?? 'No biography provided.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Driver Info -->

                        <!-- Driver Rates -->
                        <div class="tab-pane fade" id="driver-price">
                             <div class="border-bottom mb-3 pb-3">
                                <h6 class="mb-3">Pricing Details</h6>
                                <div class="row">
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">In-City Rate</h6>
                                            <p class="fs-13 fw-bold text-success">Rp {{ number_format($driver->in_city_rate, 0, ',', '.') }} / Day</p>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div class="mb-3">
                                            <h6 class="fs-14 fw-semibold mb-1">Out-of-Town Rate</h6>
                                            <p class="fs-13 fw-bold text-primary">Rp {{ number_format($driver->out_of_town_rate, 0, ',', '.') }} / Day</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Driver Rates -->

                        <!-- Documents -->
                        <div class="tab-pane fade" id="driver-docs">
                            <div class="border-bottom mb-3 pb-3">
                                <h6 class="mb-3">Uploaded Documents</h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border">
                                            <div class="card-body text-center">
                                                <h6 class="mb-3">SIM</h6>
                                                @if($driver->sim)
                                                    <a href="{{ asset($driver->sim) }}" data-fancybox="gallery" data-caption="SIM - {{ $driver->name }}">
                                                        <img src="{{ asset($driver->sim) }}" alt="SIM" class="img-fluid rounded mb-2" style="max-height: 150px; object-fit: contain;">
                                                    </a>
                                                    <div>
                                                        <a href="{{ asset($driver->sim) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Full</a>
                                                    </div>
                                                @else
                                                    <div class="text-muted p-3 bg-light rounded">Not Uploaded</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border">
                                            <div class="card-body text-center">
                                                <h6 class="mb-3">KTP</h6>
                                                @if($driver->ktp)
                                                    <a href="{{ asset($driver->ktp) }}" data-fancybox="gallery" data-caption="KTP - {{ $driver->name }}">
                                                        <img src="{{ asset($driver->ktp) }}" alt="KTP" class="img-fluid rounded mb-2" style="max-height: 150px; object-fit: contain;">
                                                    </a>
                                                     <div>
                                                        <a href="{{ asset($driver->ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Full</a>
                                                    </div>
                                                @else
                                                    <div class="text-muted p-3 bg-light rounded">Not Uploaded</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100 border">
                                            <div class="card-body text-center">
                                                <h6 class="mb-3">KK</h6>
                                                @if($driver->kk)
                                                    <a href="{{ asset($driver->kk) }}" data-fancybox="gallery" data-caption="KK - {{ $driver->name }}">
                                                        <img src="{{ asset($driver->kk) }}" alt="KK" class="img-fluid rounded mb-2" style="max-height: 150px; object-fit: contain;">
                                                    </a>
                                                     <div>
                                                        <a href="{{ asset($driver->kk) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Full</a>
                                                    </div>
                                                @else
                                                    <div class="text-muted p-3 bg-light rounded">Not Uploaded</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Documents -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /Driver Details -->

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
