@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}">
@endpush

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.drivers.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-0">
        <div class="card-body">
            <div class="add-wizard driver-steps">
                <ul class="nav d-flex align-items-center flex-wrap gap-3">
                    <li class="nav-item active">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-info-circle me-1"></i>Basic Info</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-currency-dollar me-1"></i>Pricing & Experience</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-file-text me-1"></i>Documents</a>
                    </li>
                </ul>
                <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Step 1: Basic Info -->
                    <fieldset id="first-field">
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-info-circle text-secondary me-2"></i>Personal Details</h4>
                        </div>
                        <div class="border-bottom mb-4 pb-4">                           
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Profile Photo</h6>
                                    <p>Upload Driver Photo</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="d-flex align-items-center flex-wrap row-gap-3 upload-pic">
                                        <div class="d-flex align-items-center justify-content-center avatar avatar-xxl me-3 flex-shrink-0 border rounded-circle frames">
                                            <img src="{{ asset('admin_assets/images/profile-placeholder.jpg') }}" class="img-fluid rounded-circle" alt="driver" id="image-preview" onerror="this.src='{{ asset('admin_assets/images/user.jpg') }}'">
                                        </div>   
                                        <div>
                                            <div class="drag-upload-btn btn btn-md btn-dark d-inline-flex align-items-center mb-2">
                                                <i class="ti ti-photo me-1"></i>Change
                                                <input type="file" name="photo" class="form-control image-sign" onchange="previewImage(event)">
                                            </div>
                                            <p>Recommended size is 500px x 500px</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                                      
                        </div>  
                        <div class="border-bottom mb-2 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Personal Info</h6>
                                    <p>Enter Personal Information</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" required value="{{ old('name') }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input type="text" name="phone_number" class="form-control" placeholder="e.g. 08123456789" required value="{{ old('phone_number') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-select" required>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" name="date_of_birth" class="form-control" required value="{{ old('date_of_birth') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-select" required>
                                                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="busy" {{ old('status') == 'busy' ? 'selected' : '' }}>Busy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Bio (Optional)</label>
                                                <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="d-flex align-items-center justify-content-end pt-3">
                            <button class="btn btn-primary wizard-next d-flex align-items-center" type="button">Next: Pricing<i class="ti ti-chevron-right ms-1"></i></button>
                        </div>
                    </fieldset>

                    <!-- Step 2: Pricing & Experience -->
                    <fieldset>
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-currency-dollar text-secondary me-2"></i>Rates & Experience</h4>
                        </div>                                      
                        <div class="border-bottom mb-4 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Service Rates</h6>
                                    <p>Set driver service rates logic.</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">In-City Rate (Per Day) <span class="text-danger">*</span></label>
                                                <input type="number" name="in_city_rate" class="form-control" required value="{{ old('in_city_rate') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Out-of-Town Rate (Per Day) <span class="text-danger">*</span></label>
                                                <input type="number" name="out_of_town_rate" class="form-control" required value="{{ old('out_of_town_rate') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Experience (Years) <span class="text-danger">*</span></label>
                                                <input type="number" name="experience_years" class="form-control" required value="{{ old('experience_years') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pt-3">
                            <button type="button" class="btn btn-outline-light border wizard-prev me-2"><i class="ti ti-chevron-left me-1"></i>Back</button>
                            <button type="button" class="btn btn-primary wizard-next d-flex align-items-center">Next: Documents<i class="ti ti-chevron-right ms-1"></i></button>
                        </div>
                    </fieldset>

                    <!-- Step 3: Documents -->
                    <fieldset>
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-file-text text-secondary me-2"></i>Documents</h4>
                        </div>
                        <div class="border-bottom mb-4 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Required Documents</h6>
                                    <p>Upload SIM, KTP, and KK.</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="mb-3">
                                        <label class="form-label">SIM (Driving License) <span class="text-danger">*</span></label>
                                        <input type="file" name="sim" class="form-control" accept="image/*"> <!-- Removed required for edit, but maybe needed for create if not validated in controller carefully? Controller validation says nullable. Wait, user said "SIM - nullable" in controller section, keeping it matching controller validation -->
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">KTP (ID Card) <span class="text-danger">*</span></label>
                                        <input type="file" name="ktp" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">KK (Family Card) <span class="text-danger">*</span></label>
                                        <input type="file" name="kk" class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pt-3">
                            <button type="button" class="btn btn-outline-light border wizard-prev me-2"><i class="ti ti-chevron-left me-1"></i>Back</button>
                            <button type="submit" class="btn btn-primary d-flex align-items-center"><i class="ti ti-check me-1"></i>Create Driver</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Wizard Logic
    function updateNav(index) {
        let navItems = document.querySelectorAll('.driver-steps .nav-item');
        navItems.forEach(item => item.classList.remove('active'));
        if(navItems[index]) navItems[index].classList.add('active');
    }

    document.querySelectorAll('.wizard-next').forEach(btn => {
        btn.addEventListener('click', () => {
             let current = btn.closest('fieldset');
             let next = current.nextElementSibling;
             if(next && next.tagName === 'FIELDSET') {
                 current.style.display = 'none';
                 next.style.display = 'block';
                 // Find index of next
                 let fieldsets = Array.from(document.querySelectorAll('fieldset'));
                 updateNav(fieldsets.indexOf(next)); 
             }
        });
    });

    document.querySelectorAll('.wizard-prev').forEach(btn => {
        btn.addEventListener('click', () => {
             let current = btn.closest('fieldset');
             let prev = current.previousElementSibling;
             if(prev && prev.tagName === 'FIELDSET') {
                 current.style.display = 'none';
                 prev.style.display = 'block';
                 let fieldsets = Array.from(document.querySelectorAll('fieldset'));
                 updateNav(fieldsets.indexOf(prev));
             }
        });
    });

    // Initialize
    document.querySelectorAll('fieldset').forEach((fs, index) => {
        if(index !== 0) fs.style.display = 'none';
        else fs.style.display = 'block';
    });
</script>
@endpush
