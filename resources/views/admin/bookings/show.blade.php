@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.bookings.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Booking Details <span class="text-muted">#{{ substr($booking->id, -8) }}</span></h4>
                    @php
                        $badgeClass = match($booking->status) {
                            'pending_payment' => 'badge-warning-transparent',
                            'confirmed' => 'badge-info-transparent',
                            'ongoing' => 'badge-primary-transparent',
                            'completed' => 'badge-success-transparent',
                            'cancelled' => 'badge-danger-transparent',
                             default => 'badge-secondary-transparent'
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
                    <span class="badge {{ $badgeClass }} fs-14">{{ $statusLabel }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                         <div class="col-md-6">
                            <h6 class="mb-2">Customer Info</h6>
                            <div class="p-3 border rounded bg-light">
                                <p class="mb-1"><strong>Name:</strong> {{ $booking->user->name ?? 'Unknown' }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $booking->user->email ?? '-' }}</p>
                                <p class="mb-0"><strong>Phone:</strong> {{ $booking->user->phone ?? '-' }}</p>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <h6 class="mb-2">Car Info</h6>
                             <div class="p-3 border rounded bg-light">
                                <p class="mb-1"><strong>Car:</strong> {{ $booking->car->name ?? 'Unknown' }} ({{ $booking->car->year ?? '' }})</p>
                                <p class="mb-1"><strong>Plate:</strong> {{ $booking->car->license_plate ?? '-' }}</p>
                                <p class="mb-0"><strong>Type:</strong> {{ $booking->car->transmission ?? '' }} / {{ $booking->car->fuel_type ?? '' }}</p>
                            </div>
                         </div>
                         <div class="col-12">
                             <h6 class="mb-2">Service Info</h6>
                             <div class="p-3 border rounded bg-light d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div>
                                    <small class="text-muted">Service Type</small>
                                    <h6 class="mb-0">
                                        {{ $booking->service_type == 'delivery' ? 'Diantar (Delivery)' : 'Ambil Sendiri (Self Pickup)' }}
                                    </h6>
                                </div>
                                @if($booking->service_type == 'delivery')
                                <div class="text-end" style="max-width: 50%;">
                                    <small class="text-muted">Delivery Address</small>
                                    <h6 class="mb-0 text-break">{{ $booking->delivery_address }}</h6>
                                </div>
                                @endif
                             </div>
                         </div>
                         <div class="col-12">
                             <h6 class="mb-2">Rental Schedule</h6>
                             <div class="p-3 border rounded bg-light d-flex justify-content-between align-items-center flex-wrap gap-3">
                                 <div>
                                     <small class="text-muted">Start Date</small>
                                     <h6 class="mb-0">{{ $booking->start_date->format('d M Y, H:i') }}</h6>
                                 </div>
                                 <div class="text-center">
                                     <span class="badge badge-outline-primary">{{ $booking->total_days }} Days</span>
                                 </div>
                                 <div class="text-end">
                                     <small class="text-muted">End Date</small>
                                     <h6 class="mb-0">{{ $booking->end_date->format('d M Y, H:i') }}</h6>
                                 </div>
                             </div>
                         </div>
                         <div class="col-12">
                             <h6 class="mb-2">Payment Breakdown</h6>
                             <div class="table-responsive border rounded">
                                 <table class="table table-borderless mb-0">
                                     <tbody>
                                         <tr>
                                             <td>Base Rental Price</td>
                                             <td class="text-end">IDR {{ number_format($booking->total_price - $booking->driver_fee + $booking->voucher_discount, 0, ',', '.') }}</td>
                                         </tr>
                                         @if($booking->use_driver)
                                         <tr>
                                             <td>Driver Fee</td>
                                             <td class="text-end">IDR {{ number_format($booking->driver_fee, 0, ',', '.') }}</td>
                                         </tr>
                                         @endif
                                         @if($booking->voucher_discount > 0)
                                         <tr>
                                             <td class="text-success">Voucher Discount ({{ $booking->voucher_code }})</td>
                                             <td class="text-end text-success">- IDR {{ number_format($booking->voucher_discount, 0, ',', '.') }}</td>
                                         </tr>
                                         @endif
                                         <tr class="border-top">
                                             <td class="fw-bold">Total Price</td>
                                             <td class="text-end fw-bold fs-16">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                         
                         <!-- Payment Information & Actions -->
                         <div class="col-12">
                             <h6 class="mb-2">Payment Information</h6>
                             <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card bg-primary-transparent border-primary h-100">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary"><i class="ti ti-credit-card me-2"></i>Bank Transfer</h5>
                                            <p class="mb-1"><strong>Bank Central Asia (BCA)</strong></p>
                                            <h4 class="mb-1">123 456 7890</h4>
                                            <p class="mb-0">a.n PT RentalKu Indonesia</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="card h-100">
                                        <div class="card-header">
                                            <h6 class="card-title mb-0">Upload Payment Proof</h6>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $totalPaid = $booking->payments->where('status', 'verified')->sum('amount');
                                                $remaining = $booking->total_price - $totalPaid;
                                                $hasDP = $booking->payments->where('type', 'down_payment')->where('status', 'verified')->count() > 0;
                                                $isFullyPaid = $remaining <= 0;
                                            @endphp

                                            @if(!$isFullyPaid || in_array($booking->status, ['ongoing', 'completed']))
                                                <form action="{{ route('admin.bookings.upload-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Payment Type</label>
                                                        <select name="payment_type" class="form-select" id="payment_type_select" required onchange="toggleAmountInput()">
                                                            @if($booking->status == 'pending_payment' && $totalPaid == 0)
                                                                <option value="full_payment">Full Payment (IDR {{ number_format($booking->total_price, 0, ',', '.') }})</option>
                                                                <option value="down_payment">Down Payment (IDR {{ number_format($booking->total_price * 0.5, 0, ',', '.') }})</option>
                                                            @elseif($hasDP && $remaining > 0)
                                                                <option value="repayment">Pelunasan (Repayment) (IDR {{ number_format($remaining, 0, ',', '.') }})</option>
                                                            @endif
                                                            
                                                            @if(in_array($booking->status, ['ongoing', 'completed']))
                                                                <option value="penalty_payment">Denda / Kerusakan (Penalty)</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="mb-3 d-none" id="penalty_items_div">
                                                        <label class="form-label">Penalty Items</label>
                                                        <table class="table table-bordered table-sm" id="penalty_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Description (e.g. Excess 10KM, Scratch)</th>
                                                                    <th width="150">Amount (IDR)</th>
                                                                    <th width="50"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="penalty_rows">
                                                                <!-- JS will populate this -->
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th class="text-end">Total Penalty</th>
                                                                    <th>
                                                                        <input type="number" id="total_penalty_display" class="form-control form-control-sm" readonly>
                                                                        <input type="hidden" name="amount" id="total_penalty_input">
                                                                    </th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPenaltyRow()"><i class="ti ti-plus"></i> Add Item</button>
                                                    </div>

                                                    <div class="mb-3">
                                                        <input type="file" name="payment_proof" class="form-control" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success w-100"><i class="ti ti-upload me-1"></i> Upload Proof</button>
                                                </form>

                                                @push('scripts')
                                                <script>
                                                    let penaltyIndex = 0;

                                                    function toggleAmountInput() {
                                                        const select = document.getElementById('payment_type_select');
                                                        const penaltyDiv = document.getElementById('penalty_items_div');
                                                        const totalInput = document.getElementById('total_penalty_input');
                                                        
                                                        if (select.value === 'penalty_payment') {
                                                            penaltyDiv.classList.remove('d-none');
                                                            if (penaltyIndex === 0) addPenaltyRow(); // Add first row if empty
                                                            updateTotalPenalty();
                                                        } else {
                                                            penaltyDiv.classList.add('d-none');
                                                            totalInput.value = ''; 
                                                        }
                                                    }

                                                    function addPenaltyRow() {
                                                        const tbody = document.getElementById('penalty_rows');
                                                        const row = `
                                                            <tr id="penalty_row_${penaltyIndex}">
                                                                <td><input type="text" name="penalty_items[${penaltyIndex}][description]" class="form-control form-control-sm" placeholder="Item description" required></td>
                                                                <td><input type="number" name="penalty_items[${penaltyIndex}][amount]" class="form-control form-control-sm penalty-amount" placeholder="0" oninput="updateTotalPenalty()" required></td>
                                                                <td><button type="button" class="btn btn-danger btn-sm p-1" onclick="removePenaltyRow(${penaltyIndex})"><i class="ti ti-x"></i></button></td>
                                                            </tr>
                                                        `;
                                                        tbody.insertAdjacentHTML('beforeend', row);
                                                        penaltyIndex++;
                                                    }

                                                    function removePenaltyRow(index) {
                                                        const row = document.getElementById(`penalty_row_${index}`);
                                                        if (row) row.remove();
                                                        updateTotalPenalty();
                                                    }

                                                    function updateTotalPenalty() {
                                                        let total = 0;
                                                        document.querySelectorAll('.penalty-amount').forEach(input => {
                                                            total += parseFloat(input.value || 0);
                                                        });
                                                        document.getElementById('total_penalty_display').value = total;
                                                        document.getElementById('total_penalty_input').value = total;
                                                    }
                                                </script>
                                                @endpush
                                            @else
                                                <div class="alert alert-success mb-0">
                                                    <i class="ti ti-check-circle me-1"></i> Payment Completed (Lunas)
                                                </div>
                                            @endif
                                        </div>
                                     </div>
                                </div>
                             </div>
                         </div>

                         <!-- Proof of Payment History -->
                         @if($booking->payments->isNotEmpty())
                         <div class="col-12">
                             <h6 class="mb-2">Payment History</h6>
                             <div class="row g-2">
                                 @foreach($booking->payments as $payment)
                                    <div class="col-md-4 col-6">
                                        <div class="card mb-0">
                                            <a href="{{ asset($payment->proof_file_path) }}" data-fancybox="gallery" data-caption="Payment Proof ({{ ucfirst(str_replace('_', ' ', $payment->type)) }})">
                                                <img src="{{ asset($payment->proof_file_path) }}" class="card-img-top" alt="Proof" style="height: 100px; object-fit: cover;">
                                            </a>
                                            <div class="card-footer p-2 text-center">
                                                <span class="badge {{ $payment->status == 'verified' ? 'badge-success-transparent' : ($payment->status == 'rejected' ? 'badge-danger-transparent' : 'badge-warning-transparent') }}">{{ ucfirst($payment->status) }}</span>
                                                <div class="small fw-bold mt-1">{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</div>
                                                <small class="d-block text-muted">IDR {{ number_format($payment->amount, 0, ',', '.') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                 @endforeach
                             </div>
                         </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Change Status To:</label>
                            <select name="status" class="form-select">
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi (Confirmed)</option>
                                <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>Sedang Rental (On Rental)</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai (Completed)</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
                                <hr>
                                <option value="pending_payment" {{ $booking->status == 'pending_payment' ? 'selected' : '' }}>Menunggu Pembayaran (Pending)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>
             <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Driver</h4>
                </div>
                <div class="card-body">
                     @if($booking->use_driver)
                        <div class="alert alert-info mb-0">
                            <i class="ti ti-steering-wheel me-1"></i> Customer requested a driver.
                        </div>
                        <!-- Future: Assign Driver Functionality -->
                     @else
                        <div class="alert alert-light mb-0">
                            <i class="ti ti-steering-wheel-off me-1"></i> Self-drive rental.
                        </div>
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/jquery.fancybox.min.css') }}">
@endpush
@push('scripts')
     <script src="{{ asset('admin_assets/js/jquery.fancybox.min.js') }}"></script>
@endpush
