@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">All Drivers</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All Drivers</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-plus me-2"></i>Add New Driver</a>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Table Header -->
<div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 mb-3">
    <div class="d-flex align-items-center flex-wrap row-gap-3">
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
                <th>DRIVER</th>
                <th>PHONE</th>
                <th>GENDER</th>
                <th>AGE</th>
                <th>EXPERIENCE</th>
                <th>IN-CITY RATE</th>
                <th>OUT-OF-TOWN RATE</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
            <tr>
                <td>
                    <div class="form-check form-check-md">
                        <input class="form-check-input" type="checkbox">
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.drivers.show', $driver->id) }}" class="avatar me-2 flex-shrink-0">
                            @if($driver->photo)
                                <img src="{{ asset($driver->photo) }}" class="rounded-3" alt="{{ $driver->name }}" style="object-fit:cover; width: 100%; height: 100%;">
                            @else
                                <span class="avatar-title rounded-3 bg-secondary text-white">{{ strtoupper(substr($driver->name, 0, 2)) }}</span>
                            @endif
                        </a>
                        <div>
                            <h6><a href="{{ route('admin.drivers.show', $driver->id) }}" class="fs-14 fw-semibold">{{ $driver->name }}</a></h6>
                        </div>
                    </div>
                </td>
                <td>{{ $driver->phone_number }}</td>
                <td>{{ ucfirst($driver->gender) }}</td>
                <td>{{ $driver->age }} Years</td>
                <td>{{ $driver->experience_years }} Years</td>
                <td>Rp {{ number_format($driver->in_city_rate, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($driver->out_of_town_rate, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $driver->status == 'available' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($driver->status) }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-2">
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.drivers.show', $driver->id) }}"><i class="ti ti-eye me-1"></i>View Details</a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-1" href="{{ route('admin.drivers.edit', $driver->id) }}"><i class="ti ti-edit me-1"></i>Edit</a>
                            </li>
                            <li>
                                <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item rounded-1 text-danger"><i class="ti ti-trash me-1"></i>Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            
            @if($drivers->isEmpty())
            <tr>
                <td colspan="10" class="text-center p-3">No drivers found. Click "Add New Driver" to create one.</td>
            </tr>
            @endif

        </tbody>	
    </table>
</div>
<div class="d-flex justify-content-end mt-3">
    {{ $drivers->links() }}
</div>
<!-- Custom Data Table -->
<div class="table-footer"></div>
@endsection
