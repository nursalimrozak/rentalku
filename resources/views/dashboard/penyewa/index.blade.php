@extends('layouts.customer')
@section('title', 'User Dashboard')

@section('content')
<!-- Status List -->
<ul class="status-lists">
    <li class="approve-item">
        <div class="status-info">
            <span><i class="fa-solid fa-calendar-days"></i></span>
            <p>Welcome back, {{ Auth::user()->name }}!</p>
        </div>
    </li>
    @if(!Auth::user()->is_verified)
    <li class="bg-danger-light">
        <div class="status-info">
            <span><i class="fa-solid fa-exclamation-circle"></i></span>
            <p>Your account is not verified yet. Please upload documents in Settings.</p>
        </div>
        <a href="{{ route('profile.settings') }}" class="view-detail">Go to Settings</a>
    </li>
    @endif
</ul>
<!-- /Status List -->

<!-- Content Header -->
<div class="content-header">
    <h4>Dashboard Overview</h4>
</div>
<!-- /Content Header -->

<!-- Dashboard -->
<div class="row">

    <!-- Widget Item -->
    <div class="col-lg-3 col-md-6 d-flex">
        <div class="widget-box flex-fill">
            <div class="widget-header">
                <div class="widget-content">
                    <h6>My Bookings</h6>
                    <h3>{{ Auth::user()->bookings()->count() }}</h3>
                </div>
                <div class="widget-icon">
                    <span>
                        <img src="{{ asset('customer_assets/images/book-icon.svg') }}" alt="icon">
                    </span>
                </div>
            </div>
            <a href="{{ route('my-bookings.index') }}" class="view-link">View all Bookings <i class="feather-arrow-right"></i></a>
        </div>
    </div>
    <!-- /Widget Item -->

    <!-- Widget Item -->
    <div class="col-lg-3 col-md-6 d-flex">
        <div class="widget-box flex-fill">
            <div class="widget-header">
                <div class="widget-content">
                    <h6>Total Spent</h6>
                    <h3>IDR {{ number_format(Auth::user()->bookings()->sum('total_price'), 0, ',', '.') }}</h3>
                </div>
                <div class="widget-icon">
                    <span class="bg-warning">
                        <img src="{{ asset('customer_assets/images/balance-icon.svg') }}" alt="icon">
                    </span>
                </div>
            </div>
            <a href="{{ route('my-bookings.index') }}" class="view-link">View History <i class="feather-arrow-right"></i></a>
        </div>
    </div>
    <!-- /Widget Item -->
</div>              

<div class="row">

    <!-- Last 5 Bookings -->
    <div class="col-lg-12 d-flex">
        <div class="card user-card flex-fill">
            <div class="card-header">   
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <h5>Recent Bookings</h5>    
                    </div>
                </div>
            </div>
            <div class="card-body p-0"> 
                <div class="table-responsive dashboard-table dashboard-table-info">
                    <table class="table">
                        <tbody>
                            @forelse(Auth::user()->bookings()->latest()->take(5)->get() as $booking)
                            <tr>
                                <td>
                                    <div class="table-avatar">
                                        <a href="{{ route('my-bookings.show', $booking) }}" class="avatar avatar-lg flex-shrink-0">
                                            <img class="avatar-img" src="{{ $booking->car->image ? asset('storage/' . $booking->car->image) : asset('customer_assets/images/car-01.jpg') }}" alt="Booking">
                                        </a>
                                        <div class="table-head-name flex-grow-1">
                                            <a href="{{ route('my-bookings.show', $booking) }}">{{ $booking->car->name }}</a>
                                            <p>{{ $booking->car->license_plate }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h6>Start date</h6>
                                    <p>{{ $booking->start_date->format('d M Y H:i') }}</p>
                                </td>
                                <td>
                                    <h6>End Date</h6>
                                    <p>{{ $booking->end_date->format('d M Y H:i') }}</p>
                                </td>
                                <td>
                                    <h6>Price</h6>
                                    <h5 class="text-danger">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</h5>
                                </td>
                                <td>
                                    <span class="badge {{ match($booking->status) { 'completed' => 'badge-light-success', 'cancelled' => 'badge-light-danger', 'pending_payment' => 'badge-light-warning', default => 'badge-light-secondary' } }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No recent bookings.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>
    <!-- /Last 5 Bookings -->

</div>
@endsection
