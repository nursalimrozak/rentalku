@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Customers</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Customers</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /Breadcrumb -->

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable">
                <thead class="thead-light">
                    <tr>
                        <th>NAME</th>
                        <th>CONTACT INFO</th>
                        <th>JOINED DATE</th>
                        <th>VERIFIED</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="avatar avatar-sm me-2 rounded-circle bg-primary-transparent text-primary">
                                    {{ substr($customer->name, 0, 1) }}
                                </span>
                                <h6 class="fs-14 fw-semibold mb-0">{{ $customer->name }}</h6>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fs-14 fw-medium">{{ $customer->email }}</span>
                                <span class="fs-12 text-muted">{{ $customer->phone_number ?? '-' }}</span>
                            </div>
                        </td>
                        <td>
                            {{ $customer->created_at->format('d M Y') }}
                        </td>
                        <td>
                            @if($customer->is_verified)
                                <span class="badge bg-success"><i class="ti ti-check me-1"></i> Verified</span>
                            @else
                                <span class="badge bg-danger"><i class="ti ti-x me-1"></i> Unverified</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-2">
                                    <li>
                                        <a class="dropdown-item rounded-1" href="{{ route('admin.customers.show', $customer->id) }}"><i class="ti ti-eye me-1"></i>View Details</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($customers->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center p-3">No customers found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
