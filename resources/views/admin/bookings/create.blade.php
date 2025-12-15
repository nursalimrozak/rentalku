@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.bookings.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Reservation</h4>
        </div>
        <div class="card-body">
            <!-- Wizard Navigation -->
            <ul class="nav nav-pills nav-fill mb-4" id="bookingWizard" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab" aria-controls="step1" aria-selected="true">
                        <i class="ti ti-car me-2"></i>1. Vehicle & Schedule
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab" aria-controls="step2" aria-selected="false">
                        <i class="ti ti-user me-2"></i>2. Customer & Driver
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab" aria-controls="step3" aria-selected="false">
                        <i class="ti ti-wallet me-2"></i>3. Payment & Confirmation
                    </button>
                </li>
            </ul>

            <form action="{{ route('admin.bookings.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
                @csrf
                <div class="tab-content" id="bookingWizardContent">
                    <!-- Step 1: Vehicle & Schedule -->
                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                        <div class="row g-3">
                            <!-- Rental Type -->
                            <div class="col-md-4">
                                <label class="form-label">Rental Type</label>
                                <select name="rental_type" id="rental_type" class="form-select" required>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>

                            <!-- Service Type -->
                            <div class="col-md-4">
                                <label class="form-label">Service Type</label>
                                <select name="service_type" id="service_type" class="form-select" required>
                                    <option value="self_pickup">Ambil Sendiri (Self Pickup)</option>
                                    <option value="delivery">Diantar (Delivery)</option>
                                </select>
                            </div>

                             <!-- Passengers -->
                             <div class="col-md-4">
                                <label class="form-label">Passengers</label>
                                <input type="number" name="passengers" class="form-control" min="1" value="1" required>
                            </div>

                            <!-- Delivery Address (Hidden initially) -->
                            <div class="col-12 d-none" id="delivery_address_group">
                                <label class="form-label">Delivery Address</label>
                                <textarea name="delivery_address" class="form-control" rows="2" placeholder="Enter delivery location..."></textarea>
                            </div>

                            <!-- Dates -->
                            <div class="col-md-6">
                                <label class="form-label">Start Date & Time</label>
                                <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                            </div>

                            <!-- Car Selection -->
                            <div class="col-12">
                                <label class="form-label">Select Vehicle</label>
                                <select name="car_id" id="car_id" class="form-select" required>
                                    <option value="">-- Choose a Car --</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}" data-price="{{ $car->rental_rate_per_day }}">
                                            {{ $car->name }} - {{ $car->license_plate }} (IDR {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}/day)
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-primary next-step" data-next="step2">Next: Customer <i class="ti ti-arrow-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- Step 2: Customer & Driver -->
                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                         <div class="row g-3">
                             <!-- Customer Selection -->
                            <div class="col-12">
                                <label class="form-label">Select Customer</label>
                                <div class="input-group">
                                    <select name="user_id" id="user_id" class="form-select">
                                        <option value="">-- Select Existing User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" id="btnToggleNewUser">New Customer</button>
                                </div>
                            </div>

                            <!-- New Customer Fields (Hidden) -->
                            <div class="col-12 d-none" id="new_user_group">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h6 class="mb-3">New Customer Details</h6>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="text" name="new_user_name" class="form-control" placeholder="Full Name">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="new_user_email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="new_user_phone" class="form-control" placeholder="Phone Number">
                                            </div>
                                            <div class="col-md-6">
                                                 <input type="password" name="new_user_password" class="form-control" placeholder="Default Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Driver Option -->
                            <div class="col-md-12">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="use_driver" id="use_driver" value="1">
                                    <label class="form-check-label" for="use_driver">Use Driver Service</label>
                                </div>
                            </div>

                            <!-- Driver Selection (Hidden) -->
                            <div class="col-md-12 d-none" id="driver_selection_group">
                                <label class="form-label">Select Driver</label>
                                <select name="driver_id" class="form-select">
                                    <option value="">-- Select Driver --</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }} ({{ ucfirst($driver->status) }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-prev="step1"><i class="ti ti-arrow-left ms-1"></i> Previous</button>
                            <button type="button" class="btn btn-primary next-step" data-next="step3">Next: Payment <i class="ti ti-arrow-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- Step 3: Payment & Confirmation -->
                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                        <div class="row g-3">
                            <!-- KM limit setting -->
                             <div class="col-md-6">
                                <label class="form-label">KM Limit</label>
                                <div class="input-group">
                                    <input type="number" name="km_limit" class="form-control" placeholder="e.g 200">
                                    <span class="input-group-text">KM (Leave empty for Unlimited)</span>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <label class="form-label">Excess KM Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">IDR</span>
                                    <input type="number" name="excess_km_price" class="form-control" value="0">
                                </div>
                            </div>

                            <hr>

                            <!-- Payment Type -->
                            <div class="col-md-6">
                                <label class="form-label">Payment Type</label>
                                <select name="payment_type" class="form-select" required>
                                    <option value="full_payment">Full Payment</option>
                                    <option value="down_payment">Down Payment (50%)</option>
                                </select>
                            </div>

                            <!-- Payment Note -->
                            <div class="col-md-6">
                                <label class="form-label">Payment Information</label>
                                <div class="alert alert-info py-2 mb-0">
                                    <small><i class="ti ti-info-circle me-1"></i> You will be able to upload payment proof after creating the reservation.</small>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="col-12 mt-4">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">Estimated Total</h5>
                                        <h2 class="text-primary mb-0" id="estimated_total">IDR 0</h2>
                                        <small class="text-muted">*Final price calculated on submit</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-prev="step2"><i class="ti ti-arrow-left ms-1"></i> Previous</button>
                            <button type="submit" class="btn btn-success"><i class="ti ti-check me-1"></i> Create Reservation</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Availability Error Modal -->
<div class="modal fade" id="availabilityErrorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger-transparent">
                <h5 class="modal-title text-danger"><i class="ti ti-alert-circle me-2"></i>Unavailable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="text-danger mb-3">
                    <i class="ti ti-calendar-off fs-1"></i>
                </div>
                <h4 class="mb-2">Car Not Available</h4>
                <p class="text-muted mb-0" id="availabilityErrorMessage"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Okay, I'll change</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wizard Navigation
        const triggerTabList = [].slice.call(document.querySelectorAll('#bookingWizard button'))
        triggerTabList.forEach(function (triggerEl) {
            new bootstrap.Tab(triggerEl)
        });

        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                const currentStepId = btn.closest('.tab-pane').id;
                const currentStepInputs = document.querySelectorAll('#' + currentStepId + ' [required]');
                let isValid = true;
                
                currentStepInputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        isValid = false;
                    }
                });

                if (isValid) {
                    if (currentStepId === 'step1') {
                        // Check Availability via AJAX
                        const startDate = document.getElementById('start_date').value;
                        const endDate = document.getElementById('end_date').value;
                        const carId = document.getElementById('car_id').value;
                        
                        const originalText = btn.innerHTML;
                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Checking...';
                        btn.disabled = true;

                        fetch('{{ route("admin.bookings.check-availability") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ start_date: startDate, end_date: endDate, car_id: carId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                            
                            if (data.available) {
                                const nextTabId = btn.getAttribute('data-next');
                                const triggerEl = document.querySelector('#' + nextTabId + '-tab');
                                const tab = bootstrap.Tab.getInstance(triggerEl) || new bootstrap.Tab(triggerEl);
                                tab.show();
                            } else {
                                document.getElementById('availabilityErrorMessage').textContent = data.message;
                                new bootstrap.Modal(document.getElementById('availabilityErrorModal')).show();
                            }
                        })
                        .catch(err => {
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                            console.error(err);
                            document.getElementById('availabilityErrorMessage').textContent = 'Failed to check availability. Please try again.';
                            new bootstrap.Modal(document.getElementById('availabilityErrorModal')).show();
                        });
                    } else {
                        const nextTabId = btn.getAttribute('data-next');
                        const triggerEl = document.querySelector('#' + nextTabId + '-tab');
                        const tab = bootstrap.Tab.getInstance(triggerEl) || new bootstrap.Tab(triggerEl);
                        tab.show();
                    }
                }
            });
        });

        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                const prevTabId = btn.getAttribute('data-prev');
                const triggerEl = document.querySelector('#' + prevTabId + '-tab');
                const tab = bootstrap.Tab.getInstance(triggerEl) || new bootstrap.Tab(triggerEl);
                tab.show();
            });
        });

        // Service Type Toggle
        const serviceType = document.getElementById('service_type');
        const deliveryGroup = document.getElementById('delivery_address_group');
        
        function toggleDelivery() {
             if (serviceType.value === 'delivery') {
                deliveryGroup.classList.remove('d-none');
                deliveryGroup.querySelector('textarea').setAttribute('required', 'required');
            } else {
                deliveryGroup.classList.add('d-none');
                deliveryGroup.querySelector('textarea').removeAttribute('required');
            }
        }

        serviceType.addEventListener('change', toggleDelivery);
        // Run on load
        toggleDelivery();

        // New User Toggle
        const btnToggleNewUser = document.getElementById('btnToggleNewUser');
        const newUserGroup = document.getElementById('new_user_group');
        const userSelect = document.getElementById('user_id');
        let isNewUser = false;

        btnToggleNewUser.addEventListener('click', function() {
            isNewUser = !isNewUser;
            if (isNewUser) {
                newUserGroup.classList.remove('d-none');
                userSelect.disabled = true;
                btnToggleNewUser.textContent = 'Select Existing';
            } else {
                newUserGroup.classList.add('d-none');
                userSelect.disabled = false;
                btnToggleNewUser.textContent = 'New Customer';
            }
        });

        // Driver Toggle
        const useDriver = document.getElementById('use_driver');
        const driverGroup = document.getElementById('driver_selection_group');
        useDriver.addEventListener('change', function() {
            if (this.checked) {
                driverGroup.classList.remove('d-none');
            } else {
                driverGroup.classList.add('d-none');
            }
        });

        // Price Calculation (Basic Estimate)
        function calculateTotal() {
            const carSelect = document.getElementById('car_id');
            const selectedOption = carSelect.options[carSelect.selectedIndex];
            const pricePerDay = selectedOption.getAttribute('data-price') ? parseFloat(selectedOption.getAttribute('data-price')) : 0;
            
            const startDate = new Date(document.getElementById('start_date').value);
            const endDate = new Date(document.getElementById('end_date').value);
            
            if (pricePerDay > 0 && !isNaN(startDate) && !isNaN(endDate) && endDate > startDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                const total = diffDays * pricePerDay;
                document.getElementById('estimated_total').textContent = 'IDR ' + new Intl.NumberFormat('id-ID').format(total);
            }
        }

        document.getElementById('car_id').addEventListener('change', calculateTotal);
        document.getElementById('start_date').addEventListener('change', calculateTotal);
        document.getElementById('end_date').addEventListener('change', calculateTotal);
    });
</script>
@endpush
