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
                                                $statusConfig = match($booking->status) {
                                                    'pending_payment' => ['class' => 'bg-warning', 'label' => 'Menunggu Pembayaran'],
                                                    'dp_50' => ['class' => 'bg-info', 'label' => 'DP 50% Lunas'],
                                                    'confirmed' => ['class' => 'bg-success', 'label' => 'Lunas / Terkonfirmasi'],
                                                    'ongoing' => ['class' => 'bg-primary', 'label' => 'Sedang Rental'],
                                                    'completed' => ['class' => 'bg-success', 'label' => 'Selesai'],
                                                    'cancelled' => ['class' => 'bg-danger', 'label' => 'Dibatalkan'],
                                                    'penalty_pending' => ['class' => 'bg-danger', 'label' => 'Menunggu Pembayaran Denda'],
                                                    'penalty_paid' => ['class' => 'bg-success', 'label' => 'Denda Lunas'],
                                                    default => ['class' => 'bg-secondary', 'label' => ucfirst(str_replace('_', ' ', $booking->status))]
                                                };

                                                // Override if there is a pending payment upload
                                                // Override if there is a pending payment upload AND booking isn't already confirmed/processed
                                                if ($booking->payments->contains('status', 'pending') && !in_array($booking->status, ['confirmed', 'ongoing', 'completed', 'cancelled', 'penalty_paid'])) {
                                                    $statusConfig = ['class' => 'bg-info', 'label' => 'Menunggu Verifikasi'];
                                                }
                                            @endphp
                                            <span class="badge {{ $statusConfig['class'] }} text-white">{{ $statusConfig['label'] }}</span>
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
                                            
                                            <!-- Already Paid Section -->
                                            @php
                                                $amountPaid = $booking->payments->where('status', 'verified')->sum('amount');
                                            @endphp
                                            <div class="d-flex justify-content-between mb-2 text-primary">
                                                <span>Already Paid</span>
                                                <span>Rp {{ number_format($amountPaid, 0, ',', '.') }}</span>
                                            </div>

                                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                                <strong>Total Price</strong>
                                                <strong class="text-primary fs-4">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</strong>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            @php
                                $totalPaid = $booking->payments->where('status', 'verified')->where('type', '!=', 'penalty_payment')->sum('amount');
                                $isFullyPaid = $totalPaid >= $booking->total_price;
                                $balanceDue = $booking->total_price - $totalPaid;
                                $hasPenalty = $booking->total_penalty > 0 && $booking->penalty_status != 'paid';
                            @endphp

                            <!-- Payment Information & Uploads -->
                            @if(!in_array($booking->status, ['cancelled']) && (!$isFullyPaid || $hasPenalty))
                                <div class="card mt-4 border">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Payment Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- Payment Timer -->
                                        @if($booking->status == 'pending_payment')
                                            @php
                                                $expiryTime = $booking->created_at->addMinutes(15);
                                                $remainingSeconds = now()->diffInSeconds($expiryTime, false);
                                            @endphp

                                            @if($remainingSeconds > 0)
                                                <div class="alert alert-warning text-center mb-4">
                                                    <h5 class="alert-heading text-warning mb-1"><i class="ti ti-clock me-1"></i> Segera Lakukan Pembayaran</h5>
                                                    <p class="mb-2">Selesaikan pembayaran Anda sebelum waktu habis untuk menghindari pembatalan otomatis.</p>
                                                    <h2 class="fw-bold text-danger mb-0" id="paymentTimer">--:--</h2>
                                                </div>

                                                @push('scripts')
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        let remainingTime = {{ $remainingSeconds }};
                                                        const timerElement = document.getElementById('paymentTimer');

                                                        if(timerElement) {
                                                            const timerInterval = setInterval(function() {
                                                                if (remainingTime <= 0) {
                                                                    clearInterval(timerInterval);
                                                                    timerElement.textContent = "Waktu Habis";
                                                                    timerElement.classList.remove('text-muted');
                                                                    timerElement.classList.add('text-danger');
                                                                    setTimeout(() => location.reload(), 3000);
                                                                    return;
                                                                }

                                                                const minutes = Math.floor(remainingTime / 60);
                                                                const seconds = Math.floor(remainingTime % 60);
                                                                
                                                                timerElement.textContent = `${minutes} Menit ${seconds} Detik`;
                                                                remainingTime--;
                                                            }, 1000);
                                                        }
                                                    });
                                                </script>
                                                @endpush
                                            @endif
                                        @endif
                                        <!-- Bank Accounts -->
                                        @if(!$isFullyPaid || $hasPenalty)
                                        <div class="mb-4">
                                            <p class="mb-3">Please transfer the payment to one of the following bank accounts:</p>
                                            <div class="row">
                                                @foreach($bankAccounts as $account)
                                                <div class="col-md-6 mb-3">
                                                    <div class="p-3 border rounded bg-white">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="ti ti-building-bank fs-4 me-2 text-primary"></i>
                                                            <h6 class="mb-0">{{ $account->bank_name }}</h6>
                                                        </div>
                                                        <p class="mb-1 text-dark small fw-bold">Account Number</p>
                                                        <h5 class="mb-1 copy-text" role="button" onclick="navigator.clipboard.writeText('{{ $account->account_number }}'); alert('Copied!');" title="Click to copy">
                                                            {{ $account->account_number }} <i class="ti ti-copy fs-6 ms-1 text-muted"></i>
                                                        </h5>
                                                        <p class="mb-0 text-dark small fw-bold">A.N {{ $account->account_holder }}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <!-- 1. Initial Payment (DP or Full) -->
                                        @if($booking->status == 'pending_payment')
                                            <div class="alert alert-info">
                                                <i class="ti ti-info-circle me-2"></i> 
                                                @if($booking->payment_type == 'down_payment')
                                                    <strong>Down Payment (50%) Required.</strong> Amount: Rp {{ number_format($booking->total_price * 0.5, 0, ',', '.') }}
                                                @else
                                                    <strong>Full Payment Required.</strong> Amount: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                                @endif
                                            </div>
                                            <form action="{{ route('bookings.upload-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="payment_type" value="{{ $booking->payment_type }}">
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Payment Proof</label>
                                                    <input type="file" name="payment_proof" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Upload Payment</button>
                                            </form>
                                        
                                        <!-- 2. Repayment (Pelunasan) -->
                                        @elseif(($booking->status == 'dp_50' || $booking->status == 'confirmed') && !$isFullyPaid)
                                            <div class="alert alert-warning">
                                                <i class="ti ti-alert-circle me-2"></i> 
                                                <strong>Repayment Required.</strong> Remaining Balance: Rp {{ number_format($balanceDue, 0, ',', '.') }}
                                            </div>
                                            <form action="{{ route('bookings.upload-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="payment_type" value="repayment">
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Repayment Proof</label>
                                                    <input type="file" name="payment_proof" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-warning w-100">Upload Repayment</button>
                                            </form>

                                        <!-- 3. Penalty Payment -->
                                        @elseif($hasPenalty)
                                            <div class="alert alert-danger">
                                                <i class="ti ti-exclamation-circle me-2"></i> 
                                                <strong>Penalty Payment Required.</strong> Amount: Rp {{ number_format($booking->total_penalty, 0, ',', '.') }}
                                            </div>
                                            <form action="{{ route('bookings.upload-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="payment_type" value="penalty_payment">
                                                <div class="mb-3">
                                                    <label class="form-label">Upload Penalty Proof</label>
                                                    <input type="file" name="payment_proof" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-danger w-100">Upload Penalty Payment</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Payment History -->
                            @if($booking->payments->count() > 0)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="mb-0">Payment History</h6>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking->payments as $payment)
                                            <tr>
                                                <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</td>
                                                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge {{ $payment->status == 'verified' ? 'bg-success' : ($payment->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                                        {{ $payment->status == 'pending' ? 'Menunggu Verifikasi' : ($payment->status == 'verified' ? 'Terverifikasi' : 'Ditolak') }}
                                                    </span>
                                                </td>
                                                <td>{{ $payment->note ?? '-' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
