@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">All Cars</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Cars</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2 me-2">
            <a href="javascript:void(0);" class="btn btn-white d-flex align-items-center"><i class="ti ti-printer me-2"></i>Print</a>
        </div>
        <div class="mb-2 me-2">
            <div class="dropdown">
                <a href="javascript:void(0);" class="btn btn-dark d-inline-flex align-items-center">
                    <i class="ti ti-upload me-1"></i>Export
                </a>
            </div>
        </div>
        <div class="mb-2">
            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Add New Car</a>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Table Header -->
<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 mb-3">
    <div class="d-flex align-items-center flex-wrap row-gap-3">
        <div class="dropdown me-2">
            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                <i class="ti ti-filter me-1"></i> Sort By : Latest
            </a>
            <ul class="dropdown-menu  dropdown-menu-end p-2">
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Latest</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
                </li>
            </ul>
        </div>
        <div class="me-2">
            <div class="input-icon-start position-relative topdatepicker">
                <span class="input-icon-addon">
                    <i class="ti ti-calendar"></i>
                </span>
                <input type="text" class="form-control date-range bookingrange" placeholder="dd/mm/yyyy - dd/mm/yyyy">
            </div>
        </div>                      
        <div class="dropdown">
            <a href="#filtercollapse" class="filtercollapse coloumn d-inline-flex align-items-center" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="filtercollapse">
                <i class="ti ti-filter me-1"></i> Filter <span class="badge badge-xs rounded-pill bg-danger ms-2">0</span>
            </a>
        </div>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
        <div class="dropdown me-2">
            <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
                <i class="ti ti-edit-circle me-1"></i> Bulk Actions
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-2">
                <li>
                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Delete</a>
                </li>
            </ul>
        </div>
        <div class="top-search me-2">
            <div class="top-search-group">
                <span class="input-icon">
                    <i class="ti ti-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </div>                        
        
    </div>
</div>
<!-- /Table Header -->

<div class="collapse" id="filtercollapse">
    <div class="filterbox mb-3 d-flex align-items-center">
        <h6 class="me-3">Filters</h6>
        <!-- Filters content placeholders -->
        <a href="javascript:void(0);" class="me-2 text-purple links">Apply</a>
        <a href="javascript:void(0);" class="text-danger links">Clear All</a>
    </div>
</div>

<!-- Custom Data Table -->
<div class="custom-datatable-filter table-responsive">
    <table class="table datatable">
        <thead class="thead-light">
            <tr>
                <th class="no-sort">
                    <div class="form-check form-check-md">
                        <input class="form-check-input" type="checkbox" id="select-all">
                    </div>
                </th>
                <th>CAR</th>
                <th>LICENSE PLATE</th>
                <th>PRICE (PER DAY)</th>
                <th>IS FEATURED</th>
                <th>CREATED DATE</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td>
                    <div class="form-check form-check-md">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.cars.show', $car->id) }}" class="avatar me-2 flex-shrink-0">
                            <!-- Placeholder image or car photo if available -->
                            @if($car->photo)
                                <img src="{{ asset($car->photo) }}" class="rounded-3" alt="{{ $car->name }}" style="object-fit:cover; width: 100%; height: 100%;">
                            @else
                                <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="rounded-3" alt="">
                            @endif
                        </a>
                        <div>
                            <h6><a href="#" class="fs-14 fw-semibold">{{ $car->name }}</a></h6>
                            <p>{{ $car->brand }} {{ $car->model }}</p>
                        </div>
                    </div>
                </td>
                <td>
                    {{ $car->license_plate }}
                </td>
                <td>
                    <p class="fs-14 fw-semibold text-gray-9">{{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</p>
                </td>
                <td>
                    <i class="ti ti-star-filled {{ $car->is_featured ? 'text-warning' : 'text-gray-2' }}"></i>
                </td>
                <td>
                    <h6 class="fs-14 fw-normal">{{ $car->created_at->format('d M Y') }}</h6>
                    <p class="fs-13">{{ $car->created_at->format('h:i A') }}</p>
                </td>
                <td>
                    <span class="badge badge-dark-transparent"><i class="ti ti-point-filled text-success me-1"></i>{{ ucfirst($car->status) }}</span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.cars.show', $car->id) }}"><i class="ti ti-eye me-1"></i>View Details</a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.cars.edit', $car->id) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_car_{{ $car->id }}"><i class="ti ti-trash me-1"></i>Delete</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            
            <!-- Example Static Row if no cars empty state -->
            @if($cars->isEmpty())
            <tr>
                <td colspan="6" class="text-center p-3">No cars found. Click "Add New Car" to create one.</td>
            </tr>
            @endif

        </tbody>	
    </table>
</div>
<!-- Custom Data Table -->
<div class="table-footer"></div>
@endsection
