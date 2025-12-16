@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.customers.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
    </div>

    <div class="row">
        <!-- Customer Profile -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body text-center">
                    <span class="avatar avatar-xl rounded-circle bg-primary text-white fs-24 mb-3" style="width: 100px; height: 100px; overflow: hidden;">
                        @if($customer->profile_photo_path)
                            <img src="{{ asset('storage/' . $customer->profile_photo_path) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            {{ substr($customer->name, 0, 1) }}
                        @endif
                    </span>
                    <h4 class="card-title mb-1">{{ $customer->name }}</h4>
                    <p class="text-muted mb-3">{{ $customer->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        @if($customer->is_verified)
                            <span class="badge bg-success"><i class="ti ti-check me-1"></i> Verified Account</span>
                        @else
                            <span class="badge bg-danger"><i class="ti ti-x me-1"></i> Unverified Account</span>
                            <!-- Verify Button Condition: KTP and SIM must present -->
                            @if($customer->documents->where('type', 'ktp')->count() > 0 && $customer->documents->where('type', 'sim')->count() > 0)
                                <form action="{{ route('admin.customers.verify', $customer->id) }}" method="POST" onsubmit="return confirm('Verify this account?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success"><i class="ti ti-check"></i> Verify Account</button>
                                </form>
                            @endif
                        @endif
                    </div>

                    <div class="text-start mt-4">
                        <h6 class="mb-2">Contact Info</h6>
                        <div class="p-3 bg-light rounded fs-13">
                            <p class="mb-2"><i class="ti ti-phone me-2"></i> {{ $customer->phone_number ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="text-start mt-3">
                        <h6 class="mb-2">KTP Address</h6>
                        <div class="p-3 bg-light rounded fs-13">
                            @if($customer->ktp_address)
                                <p class="mb-1 fw-medium">{{ $customer->ktp_address }}</p>
                                <p class="mb-1">Desa/Kel: {{ $customer->ktp_village }}, Kec: {{ $customer->ktp_district }}</p>
                                <p class="mb-1">{{ $customer->ktp_city }}, {{ $customer->ktp_province }}</p>
                                <p class="mb-0">Kode Pos: {{ $customer->ktp_zip }}</p>
                            @else
                                <p class="mb-0 text-muted">Not Set</p>
                            @endif
                        </div>
                    </div>

                    <div class="text-start mt-3">
                        <h6 class="mb-2">Domicile Address</h6>
                        <div class="p-3 bg-light rounded fs-13">
                             @if($customer->dom_address)
                                <p class="mb-1 fw-medium">{{ $customer->dom_address }}</p>
                                <p class="mb-1">Desa/Kel: {{ $customer->dom_village }}, Kec: {{ $customer->dom_district }}</p>
                                <p class="mb-1">{{ $customer->dom_city }}, {{ $customer->dom_province }}</p>
                                <p class="mb-0">Kode Pos: {{ $customer->dom_zip }}</p>
                            @else
                                <p class="mb-0 text-muted">Same as KTP Address</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-start mt-4">
                         <h6 class="mb-2">Documents</h6>
                         <div class="row g-2">
                             @php
                                 $docMap = [
                                     'ktp' => 'KTP', 
                                     'sim' => 'SIM', 
                                     'kk' => 'KK', 
                                     'akte' => 'Akte', 
                                     'ijazah' => 'Ijazah',
                                     'employee_card' => 'Kartu Pegawai', 
                                     'student_card' => 'Kartu Mahasiswa', 
                                     'passport' => 'Paspor'
                                 ];
                                 $uploadedDocs = $customer->documents->keyBy('type');
                             @endphp
                             
                             @foreach($docMap as $type => $label)
                                 @php
                                     $doc = $uploadedDocs->get($type);
                                 @endphp
                                 <div class="col-12">
                                     <div class="p-2 border rounded">
                                         <div class="d-flex justify-content-between align-items-center mb-1">
                                             <span class="fw-medium"><i class="ti ti-file-description me-1"></i> {{ $label }}</span>
                                             @if($doc)
                                                <span class="badge {{ match($doc->status) { 'verified' => 'bg-success', 'rejected' => 'bg-danger', default => 'bg-warning' } }}">
                                                    {{ ucfirst($doc->status) }}
                                                </span>
                                             @else
                                                <span class="badge bg-secondary">Empty</span>
                                             @endif
                                         </div>
                                         
                                         @if($doc)
                                             <div class="d-flex justify-content-between align-items-center mt-2">
                                                 <a href="{{ route('documents.show', $doc->id) }}" target="_blank" class="btn btn-xs btn-outline-primary">View</a>
                                                 
                                                 <div>
                                                     @if($doc->status != 'verified')
                                                     <form action="{{ route('admin.documents.update-status', $doc->id) }}" method="POST" class="d-inline">
                                                         @csrf
                                                         <input type="hidden" name="status" value="verified">
                                                         <button type="submit" class="btn btn-xs btn-success" title="Approve"><i class="ti ti-check"></i></button>
                                                     </form>
                                                     @endif
                                                     
                                                     @if($doc->status != 'rejected')
                                                     <button type="button" class="btn btn-xs btn-danger" onclick="rejectDoc({{ $doc->id }})" title="Reject"><i class="ti ti-x"></i></button>
                                                     @endif
                                                 </div>
                                             </div>
                                             @if($doc->status == 'rejected')
                                                <div class="mt-1 text-danger fs-11">Reason: {{ $doc->rejection_reason }}</div>
                                             @endif
                                         @endif
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                    </div>

                    <div class="text-start mt-4">
                        <h6 class="mb-2">Statistics</h6>
                        <div class="row g-2">
                             <div class="col-6">
                                 <div class="p-3 bg-light rounded text-center">
                                     <h5 class="mb-0">{{ $totalRentals }}</h5>
                                     <small class="text-muted">Total Rentals</small>
                                 </div>
                             </div>
                             <div class="col-6">
                                 <div class="p-3 bg-light rounded text-center">
                                     <h5 class="mb-0">IDR {{ number_format($totalSpent, 0, ',', '.') }}</h5>
                                     <small class="text-muted">Total Spent</small>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking History -->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Booking History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Car</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->bookings as $booking)
                                <tr>
                                    <td>
                                        <span class="fw-medium">#{{ substr($booking->id, -8) }}</span>
                                    </td>
                                    <td>
                                        {{ $booking->car->name ?? 'Unknown Car' }}
                                        <br>
                                        <small class="text-muted">{{ $booking->car->license_plate ?? '-' }}</small>
                                    </td>
                                    <td>
                                        {{ $booking->start_date->format('d M Y') }}
                                        <br>
                                        <small class="text-muted">{{ $booking->total_days }} Days</small>
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
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-light">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No bookings found.</td>
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

@section('scripts')
<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="rejectForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="status" value="rejected">
                    <div class="mb-3">
                        <label class="form-label">Reason for Rejection</label>
                        <textarea name="reason" class="form-control" required rows="3" placeholder="e.g. Blurry image, Expired document"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function rejectDoc(id) {
        let url = "{{ route('admin.documents.update-status', ':id') }}";
        url = url.replace(':id', id);
        document.getElementById('rejectForm').action = url;
        new bootstrap.Modal(document.getElementById('rejectModal')).show();
    }
</script>
@endsection
