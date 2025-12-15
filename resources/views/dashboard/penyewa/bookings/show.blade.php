@extends('layouts.customer')
@section('title', 'Booking Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="settings-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Booking Details #{{ substr($booking->id, -8) }}</h4>
                    <a href="{{ route('my-bookings.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left me-2"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Car Information -->
                        <div class="col-md-4">
                            <h5>Vehicle Information</h5>
                            <div class="card mb-3">
                                @if($booking->car->photo)
                                    <img src="{{ asset($booking->car->photo) }}" class="card-img-top" alt="{{ $booking->car->name }}">
                                @else
                                    <img src="{{ asset('admin_assets/images/car-01.jpg') }}" class="card-img-top" alt="{{ $booking->car->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title mb-3">{{ $booking->car->name }}</h5>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <i class="fa-solid fa-car me-2 text-dark" style="width: 20px;"></i>
                                            {{ $booking->car->brand }}
                                        </div>
                                        <div class="col-12">
                                            <i class="fa-solid fa-id-card me-2 text-dark" style="width: 20px;"></i>
                                            {{ $booking->car->license_plate }}
                                        </div>
                                        <div class="col-12">
                                            <i class="fa-solid fa-gears me-2 text-dark" style="width: 20px;"></i>
                                            {{ ucfirst($booking->car->transmission) }}
                                        </div>
                                        <div class="col-12">
                                            <i class="fa-solid fa-gas-pump me-2 text-dark" style="width: 20px;"></i>
                                            {{ ucfirst($booking->car->fuel_type) }}
                                        </div>
                                        <div class="col-12">
                                            <i class="fa-solid fa-users me-2 text-dark" style="width: 20px;"></i>
                                            {{ $booking->car->seating_capacity }} Passengers
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Information -->
                        <div class="col-md-8">
                            <h5>Booking Summary</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Status</th>
                                        <td>
                                            @php
                                                $badgeClass = match($booking->status) {
                                                    'pending_payment' => 'bg-warning',
                                                    'confirmed' => 'bg-info',
                                                    'ongoing' => 'bg-primary',
                                                    'completed' => 'bg-success',
                                                    'cancelled' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} text-white">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Service Type</th>
                                        <td>{{ ucfirst(str_replace('_', ' ', $booking->service_type)) }}</td>
                                    </tr>
                                    @if($booking->service_type === 'delivery')
                                    <tr>
                                        <th>Delivery Address</th>
                                        <td>{{ $booking->delivery_address }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Driver</th>
                                        <td>{{ $booking->use_driver ? 'Yes (+Rp ' . number_format($booking->driver_fee, 0, ',', '.') . ')' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Duration</th>
                                        <td>
                                            {{ $booking->start_date->format('d M Y H:i') }} - {{ $booking->end_date->format('d M Y H:i') }} <br>
                                            ({{ $booking->total_days }} Days)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Price Breakdown</th>
                                        <td>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Rental Price ({{ $booking->total_days }} days)</span>
                                                <span>Rp {{ number_format($booking->car->rental_rate_per_day * $booking->total_days, 0, ',', '.') }}</span>
                                            </div>
                                            @if($booking->use_driver)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Driver Fee ({{ $booking->total_days }} days)</span>
                                                <span>+ Rp {{ number_format($booking->driver_fee, 0, ',', '.') }}</span>
                                            </div>
                                            @endif
                                            @if($booking->voucher_discount > 0)
                                            <div class="d-flex justify-content-between mb-2 text-success">
                                                <span>Voucher Discount ({{ $booking->voucher_code }})</span>
                                                <span>- Rp {{ number_format($booking->voucher_discount, 0, ',', '.') }}</span>
                                            </div>
                                            @endif
                                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                                <strong>Total Price</strong>
                                                <strong class="text-primary fs-4">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            @if($booking->status === 'pending_payment')
                                <div class="alert alert-warning mt-3">
                                    <i class="ti ti-info-circle me-2"></i> 
                                    Please proceed with payment to confirm your booking.
                                </div>
                                <button class="btn btn-primary w-100 mt-2">Proceed to Payment (Wait for implementation)</button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
