@extends('layouts.customer')
@section('title', 'My Bookings')

@section('content')
<div class="row">
    <!-- Content -->
    <div class="col-12">
        <div class="settings-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">My Bookings</h4>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="ti ti-plus me-2"></i> Book Vehicle
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Car</th>
                                            <th>Dates</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                        <tr>
                                            <td>#{{ substr($booking->id, -8) }}</td>
                                            <td>
                                                {{ $booking->car->name }} <br>
                                                <small>{{ $booking->car->license_plate }}</small>
                                            </td>
                                            <td>
                                                {{ $booking->start_date->format('d M Y H:i') }} <br>
                                                to {{ $booking->end_date->format('d M Y H:i') }}
                                            </td>
                                            <td>IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
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
                                            <td>
                                                <a href="{{ route('my-bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">Details</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No bookings found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                            </table>
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
