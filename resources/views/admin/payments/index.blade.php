@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between mb-3">
                <h4 class="mb-sm-0">Payments Overview</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>INVOICE ID</th>
                                    <th>CUSTOMER</th>
                                    <th>DATE</th>
                                    <th>TOTAL AMOUNT</th>
                                    <th>ALREADY PAID</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td>#{{ substr($booking->id, -8) }}</td>
                                    <td>
                                        <h6 class="fs-14 fw-medium mb-0">{{ $booking->user->name ?? 'Unknown' }}</h6>
                                        <span class="text-muted fs-12">{{ $booking->car->name ?? '-' }}</span>
                                    </td>
                                    <td>
                                        {{ $booking->created_at->format('d M Y') }}
                                        <br>
                                        <small class="text-muted">{{ $booking->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="{{ $booking->total_paid > 0 ? 'text-success' : 'text-muted' }}">
                                            IDR {{ number_format($booking->total_paid, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $booking->payment_status_badge }}">{{ $booking->payment_status_label }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center p-5">
                                        <img src="{{ asset('admin_assets/images/no-data.svg') }}" alt="No Data" class="img-fluid mb-3" style="max-height: 150px;">
                                        <h5 class="text-muted">No Payment Records Found</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
