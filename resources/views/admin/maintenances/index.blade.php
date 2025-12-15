@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Vehicle Maintenance</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Maintenance</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.maintenances.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Schedule Maintenance</a>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Custom Data Table -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable">
                <thead class="thead-light">
                    <tr>
                        <th>CAR</th>
                        <th>DATE</th>
                        <th>END DATE</th>
                        <th>DESCRIPTION</th>
                        <th>COST</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenances as $maintenance)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('admin.cars.show', $maintenance->car_id) }}" class="avatar me-2 flex-shrink-0">
                                    @if($maintenance->car->photo)
                                        <img src="{{ asset($maintenance->car->photo) }}" class="rounded-3" alt="{{ $maintenance->car->name }}" style="object-fit:cover; width: 100%; height: 100%;">
                                    @else
                                        <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="rounded-3" alt="">
                                    @endif
                                </a>
                                <div>
                                    <h6><a href="{{ route('admin.cars.show', $maintenance->car_id) }}" class="fs-14 fw-semibold">{{ $maintenance->car->name }}</a></h6>
                                    <p>{{ $maintenance->car->license_plate }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $maintenance->date->format('d M Y') }}
                        </td>
                        <td>
                            {{ $maintenance->end_date ? $maintenance->end_date->format('d M Y') : '-' }}
                        </td>
                        <td>
                            {{ Str::limit($maintenance->description, 50) }}
                        </td>
                        <td>
                            <p class="fs-14 fw-semibold text-gray-9">{{ number_format($maintenance->cost, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            @php
                                $badgeClass = match($maintenance->status) {
                                    'scheduled' => 'badge-info-transparent',
                                    'ongoing' => 'badge-warning-transparent',
                                    'completed' => 'badge-success-transparent',
                                    default => 'badge-secondary-transparent'
                                };
                                $iconClass = match($maintenance->status) {
                                    'scheduled' => 'ti-calendar',
                                    'ongoing' => 'ti-hourglass-low',
                                    'completed' => 'ti-check',
                                    default => 'ti-circle'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}"><i class="ti {{ $iconClass }} me-1"></i>{{ ucfirst($maintenance->status) }}</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-2">
                                    <li>
                                        <a class="dropdown-item rounded-1" href="{{ route('admin.maintenances.edit', $maintenance->id) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.maintenances.destroy', $maintenance->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded-1 text-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="ti ti-trash me-1"></i>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($maintenances->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center p-3">No maintenance records found.</td>
                    </tr>
                    @endif
        
                </tbody>	
            </table>
        </div>
    </div>
</div>
<!-- Custom Data Table -->
@endsection
