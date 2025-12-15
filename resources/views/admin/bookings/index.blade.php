@extends('layouts.admin')

@section('content')
<!-- Breadcrumb -->
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Reservations</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Reservations</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary d-inline-flex align-items-center">
            <i class="ti ti-plus me-1"></i> Add Reservation
        </a>
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
                        <th>BOOKING ID</th>
                        <th>USER</th>
                        <th>CAR</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>
                            <span class="fs-14 fw-semibold text-gray-9">#{{ substr($booking->id, -8) }}</span>
                            <br>
                            <span class="fs-12 text-muted">{{ $booking->created_at->format('d M Y H:i') }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="avatar avatar-sm me-2 rounded-circle bg-primary-transparent text-primary">
                                    {{ substr($booking->user->name ?? 'U', 0, 1) }}
                                </span>
                                <div>
                                    <h6 class="fs-14 fw-semibold">{{ $booking->user->name ?? 'Unknown' }}</h6>
                                    <p class="fs-13">{{ $booking->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                         <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('admin.cars.show', $booking->car_id) }}" class="avatar me-2 flex-shrink-0">
                                    @if($booking->car->photo)
                                        <img src="{{ asset($booking->car->photo) }}" class="rounded-3" alt="{{ $booking->car->name ?? 'Car' }}" style="object-fit:cover; width: 100%; height: 100%;">
                                    @else
                                        <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="rounded-3" alt="">
                                    @endif
                                </a>
                                <div>
                                    <h6><a href="{{ route('admin.cars.show', $booking->car_id) }}" class="fs-14 fw-semibold">{{ $booking->car->name ?? 'Unknown Car' }}</a></h6>
                                    <p>{{ $booking->car->license_plate ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fs-14 fw-medium">{{ $booking->start_date->format('d M Y') }}</span>
                                <span class="fs-12 text-muted">{{ $booking->start_date->format('H:i') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fs-14 fw-medium">{{ $booking->end_date->format('d M Y') }}</span>
                                <span class="fs-12 text-muted">{{ $booking->end_date->format('H:i') }}</span>
                            </div>
                        </td>
                        <td>
                            <p class="fs-14 fw-semibold text-gray-9">{{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            @php
                                $badgeClass = match($booking->status) {
                                    'pending_payment' => 'bg-warning',
                                    'confirmed' => 'bg-info',
                                    'ongoing' => 'bg-primary',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    'refund_pending' => 'bg-warning',
                                    'refunded' => 'bg-secondary',
                                    'payment_failed' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                                $statusLabel = match($booking->status) {
                                     'confirmed' => 'Terkonfirmasi',
                                     'ongoing' => 'Sedang Rental',
                                     'completed' => 'Selesai',
                                     'cancelled' => 'Dibatalkan',
                                     'pending_payment' => 'Menunggu Pembayaran',
                                     default => ucfirst(str_replace('_', ' ', $booking->status))
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-2">
                                    <li>
                                        <a class="dropdown-item rounded-1" href="{{ route('admin.bookings.show', $booking->id) }}"><i class="ti ti-eye me-1"></i>View Details</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if($bookings->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center p-3">No reservations found.</td>
                    </tr>
                    @endif
        
                </tbody>	
            </table>
        </div>
    </div>
</div>
<!-- Custom Data Table -->
@endsection
