@extends('layouts.customer')
@section('title', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="settings-content">
            <!-- Profile Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Profile Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12 mb-3 text-center">
                                <div class="d-inline-block position-relative">
                                    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('customer_assets/images/avatar-14.jpg') }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="mt-2">
                                        <input type="file" name="profile_photo" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ Auth::user()->phone_number }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <h6>KTP Address</h6>
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <label>Street Address</label>
                                <input type="text" class="form-control" name="ktp_address" value="{{ Auth::user()->ktp_address }}">
                            </div>
                            <div class="col-md-6 col-12 mb-3"><label>Village (Desa/Kel)</label><input type="text" class="form-control" name="ktp_village" value="{{ Auth::user()->ktp_village }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>District (Kecamatan)</label><input type="text" class="form-control" name="ktp_district" value="{{ Auth::user()->ktp_district }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>City (Kab/Kota)</label><input type="text" class="form-control" name="ktp_city" value="{{ Auth::user()->ktp_city }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>Province</label><input type="text" class="form-control" name="ktp_province" value="{{ Auth::user()->ktp_province }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>Zip Code</label><input type="text" class="form-control" name="ktp_zip" value="{{ Auth::user()->ktp_zip }}"></div>
                        </div>

                        <hr>
                        <h6>Domicile Address</h6>
                        <div class="row mt-2">
                            <div class="col-12 mb-3">
                                <label>Street Address</label>
                                <input type="text" class="form-control" name="dom_address" value="{{ Auth::user()->dom_address }}" placeholder="Leave empty if same as KTP">
                            </div>
                            <div class="col-md-6 col-12 mb-3"><label>Village (Desa/Kel)</label><input type="text" class="form-control" name="dom_village" value="{{ Auth::user()->dom_village }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>District (Kecamatan)</label><input type="text" class="form-control" name="dom_district" value="{{ Auth::user()->dom_district }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>City (Kab/Kota)</label><input type="text" class="form-control" name="dom_city" value="{{ Auth::user()->dom_city }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>Province</label><input type="text" class="form-control" name="dom_province" value="{{ Auth::user()->dom_province }}"></div>
                            <div class="col-md-6 col-12 mb-3"><label>Zip Code</label><input type="text" class="form-control" name="dom_zip" value="{{ Auth::user()->dom_zip }}"></div>
                        </div>
                            
                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Document Upload Section -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>My Documents</h4>
                        <p class="text-muted mb-0">Required: KTP & SIM. Others are optional.</p>
                    </div>
                    <div>
                        @if(Auth::user()->is_verified)
                            <span class="badge bg-success">Account Verified <i class="fas fa-check-circle"></i></span>
                        @else
                            <span class="badge bg-warning text-dark">Not Verified <i class="fas fa-exclamation-circle"></i></span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @php
                            $docTypes = [
                                'ktp' => ['label' => 'KTP (Identity Card)', 'required' => true],
                                'sim' => ['label' => 'SIM (Driver License)', 'required' => true],
                                'kk' => ['label' => 'KK (Family Card)', 'required' => false],
                                'acte' => ['label' => 'Akte Kelahiran', 'required' => false],
                                'ijazah' => ['label' => 'Ijazah', 'required' => false],
                                'employee_card' => ['label' => 'Kartu Pegawai', 'required' => false],
                                'student_card' => ['label' => 'Kartu Mahasiswa', 'required' => false],
                                'passport' => ['label' => 'Passport', 'required' => false],
                            ];
                            $uploadedDocs = Auth::user()->documents->keyBy('type');
                        @endphp

                        @foreach($docTypes as $key => $info)
                            @php $doc = $uploadedDocs->get($key); @endphp
                            <div class="col-md-6 col-12">
                                <div class="border rounded p-3 h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="{{ $info['required'] ? 'text-danger' : '' }}">{{ $info['label'] }} {{ $info['required'] ? '*' : '' }}</h6>
                                        @if($doc)
                                            @if($doc->status == 'verified')
                                                <span class="badge bg-success">Verified</span>
                                            @elseif($doc->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Empty</span>
                                        @endif
                                    </div>
                                    
                                    @if($doc)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info w-100 mb-1">View File</a>
                                        </div>
                                        @if($doc->status == 'rejected')
                                            <small class="text-danger d-block mb-2">Reason: {{ $doc->rejection_reason }}</small>
                                        @endif
                                    @endif

                                    <button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $key }}">
                                        {{ $doc ? 'Re-upload' : 'Upload' }}
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadModal{{ $key }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('profile.upload-document') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Upload {{ $info['label'] }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="type" value="{{ $key }}">
                                                        <div class="mb-3">
                                                            <label>Select File (Image/PDF, Max 5MB)</label>
                                                            <input type="file" name="document_file" class="form-control" required accept=".jpg,.jpeg,.png,.pdf">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
