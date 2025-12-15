@extends('layouts.admin')

@push('styles')
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/bootstrap-tagsinput.css') }}">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/jquery.fancybox.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/select2.min.css') }}">
@endpush

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.cars.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
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
            <div class="add-wizard car-steps">
                <ul class="nav d-flex align-items-center flex-wrap gap-3">
                    <li class="nav-item active">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-info-circle me-1"></i>Basic</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-files me-1"></i>Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link d-flex align-items-center"><i class="ti ti-photo me-1"></i>Photos</a>
                    </li>
                </ul>
                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Step 1: Basic Info -->
                    <fieldset id="first-field">
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-info-circle text-secondary me-2"></i>Basic Info</h4>
                        </div>
                        <div class="border-bottom mb-4 pb-4">                           
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Featured Image</h6>
                                    <p>Upload Featured Image</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="d-flex align-items-center flex-wrap row-gap-3 upload-pic">
                                        <div class="d-flex align-items-center justify-content-center avatar avatar-xxl me-3 flex-shrink-0 border rounded-circle frames">
                                            <img src="{{ asset('admin_assets/images/car-02.jpg') }}" class="img-fluid rounded-circle" alt="car" id="image-preview">
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
                                    <h6 class="mb-1">Car Info</h6>
                                    <p>Add Information About Car</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="e.g. Innova Reborn V" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Car Type <span class="text-danger">*</span></label>
                                                <input type="text" name="car_type" class="form-control" list="car_type_list" placeholder="Select or Type New" required>
                                                <datalist id="car_type_list">
                                                    @foreach($car_types as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Brand <span class="text-danger">*</span></label>
                                                <input type="text" name="brand" class="form-control" list="brand_list" placeholder="Select or Type New" required>
                                                <datalist id="brand_list">
                                                    @foreach($brands as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Model <span class="text-danger">*</span></label>
                                                <input type="text" name="model" class="form-control" list="model_list" placeholder="Select or Type New" required>
                                                <datalist id="model_list">
                                                    @foreach($models as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Color <span class="text-danger">*</span></label>
                                                <input type="text" name="color" class="form-control" list="color_list" placeholder="Select or Type New" required>
                                                <datalist id="color_list">
                                                    @foreach($colors as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Year <span class="text-danger">*</span></label>
                                                <input type="number" name="year" class="form-control" list="year_list" placeholder="YYYY" required>
                                                <datalist id="year_list">
                                                    @foreach($years as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Transmission <span class="text-danger">*</span></label>
                                                <input type="text" name="transmission" class="form-control" list="transmission_list" placeholder="Select or Type New" required>
                                                <datalist id="transmission_list">
                                                    <option value="Automatic">
                                                    <option value="Manual">
                                                    @foreach($transmissions as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                                                <input type="text" name="fuel_type" class="form-control" list="fuel_type_list" placeholder="Select or Type New" required>
                                                <datalist id="fuel_type_list">
                                                    <option value="Petrol">
                                                    <option value="Diesel">
                                                    <option value="Electric">
                                                    <option value="Hybrid">
                                                    @foreach($fuel_types as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Seating Capacity <span class="text-danger">*</span></label>
                                                <input type="number" name="seating_capacity" class="form-control" list="seating_list" placeholder="e.g. 5" required>
                                                <datalist id="seating_list">
                                                    <option value="2">
                                                    <option value="4">
                                                    <option value="5">
                                                    <option value="7">
                                                    @foreach($seating_capacities as $item)
                                                        <option value="{{ $item }}">
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">License Plate <span class="text-danger">*</span></label>
                                                <input type="text" name="license_plate" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="3"></textarea>
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

                    <!-- Step 2: Pricing -->
                    <fieldset>
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-files text-secondary me-2"></i>Pricing & Fees</h4>
                        </div>                                      
                        <div class="border-bottom mb-4 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Rental Pricing</h6>
                                    <p>Set base rental price and limits.</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rental Rate Per Day (IDR) <span class="text-danger">*</span></label>
                                                <input type="number" name="rental_rate_per_day" id="rate_daily" class="form-control" required oninput="calculateRates()">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rental Rate Per Week (7 Days)</label>
                                                <input type="number" name="rental_rate_per_week" id="rate_weekly" class="form-control" placeholder="Auto-calculated">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Rental Rate Per Month (30 Days)</label>
                                                <input type="number" name="rental_rate_per_month" id="rate_monthly" class="form-control" placeholder="Auto-calculated">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Penalty Per KM (IDR)</label>
                                                <input type="number" name="penalty_per_km" class="form-control" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-4 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Driver Fees</h6>
                                    <p>Set driver fees for In/Out city trips.</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Driver Fee In City (IDR) <span class="text-danger">*</span></label>
                                                <input type="number" name="driver_fee_in_city" class="form-control" required value="150000">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Driver Fee Out Town (IDR) <span class="text-danger">*</span></label>
                                                <input type="number" name="driver_fee_out_town" class="form-control" required value="250000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pt-3">
                            <button type="button" class="btn btn-outline-light border wizard-prev me-2"><i class="ti ti-chevron-left me-1"></i>Back</button>
                            <button type="button" class="btn btn-primary wizard-next d-flex align-items-center">Next: Photos<i class="ti ti-chevron-right ms-1"></i></button>
                        </div>
                    </fieldset>

                    <!-- Step 3: Photos -->
                    <fieldset>
                        <div class="filterbox p-20 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <h4 class="d-flex align-items-center"><i class="ti ti-photo text-secondary me-2"></i>Car Gallery</h4>
                        </div>
                        <div class="border-bottom mb-4 pb-2">                               
                            <div class="row row-gap-4">
                                <div class="col-xl-3">
                                    <h6 class="mb-1">Gallery Images</h6>
                                    <p>Upload up to 5 photos.</p>
                                </div>
                                <div class="col-xl-9">
                                    <div class="mb-3">
                                        <label class="form-label">Upload Photos (Max 5, 2MB each)</label>
                                        <input type="file" name="photos[]" class="form-control" multiple accept="image/*" onchange="previewGallery(event)">
                                        <div id="gallery-preview" class="d-flex gap-2 mt-2 flex-wrap"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pt-3">
                            <button type="button" class="btn btn-outline-light border wizard-prev me-2"><i class="ti ti-chevron-left me-1"></i>Back</button>
                            <button type="submit" class="btn btn-primary d-flex align-items-center">Submit Car</button>
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

    function calculateRates() {
        let daily = parseFloat(document.getElementById('rate_daily').value) || 0;
        if(daily > 0) {
            document.getElementById('rate_weekly').value = daily * 7;
            document.getElementById('rate_monthly').value = daily * 30;
        }
    }

    function previewGallery(event) {
        var output = document.getElementById('gallery-preview');
        output.innerHTML = ''; // clear previous
        var files = event.target.files;
        
        if (files.length > 5) {
            alert("Maximum 5 photos allowed");
            event.target.value = ""; 
            return;
        }

        for(var i = 0; i < files.length; i++) {
            if(files[i].size > 2 * 1024 * 1024) {
               alert("File " + files[i].name + " is too big (Max 2MB)");
               event.target.value = "";
               return;
            }
            var reader = new FileReader();
            reader.onload = function(e){
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.className = 'rounded border';
                output.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
    }

    // Simple Wizard Logic if not using external plugin
    document.querySelectorAll('.wizard-next').forEach(btn => {
        btn.addEventListener('click', () => {
             // Logic to switch fieldsets would go here if not handled by theme js
             // For now assuming theme JS handles .add-wizard class
             // But if theme js is missing, we might need manual toggle.
             // Let's implement manual toggle just in case.
             let current = btn.closest('fieldset');
             let next = current.nextElementSibling;
             if(next) {
                 current.style.display = 'none';
                 next.style.display = 'block';
                 updateNav(1); 
             }
        });
    });

    document.querySelectorAll('.wizard-prev').forEach(btn => {
        btn.addEventListener('click', () => {
             let current = btn.closest('fieldset');
             let prev = current.previousElementSibling;
             if(prev) {
                 current.style.display = 'none';
                 prev.style.display = 'block';
                 updateNav(0);
             }
        });
    });

    function updateNav(index) {
        let navItems = document.querySelectorAll('.add-wizard .nav-item');
        navItems.forEach(item => item.classList.remove('active'));
        navItems[index].classList.add('active');
    }
    
    // Initialize first fieldset visible, others hidden
    document.querySelectorAll('fieldset').forEach((fs, index) => {
        if(index !== 0) fs.style.display = 'none';
        else fs.style.display = 'block';
    });
</script>
@endpush
