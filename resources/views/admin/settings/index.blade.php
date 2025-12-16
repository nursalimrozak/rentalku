@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Application Settings</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Settings</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">General Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-tabs-solid nav-justified" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#general" data-bs-toggle="tab">General</a></li>
                            <li class="nav-item"><a class="nav-link" href="#seo" data-bs-toggle="tab">SEO</a></li>
                            <li class="nav-item"><a class="nav-link" href="#social" data-bs-toggle="tab">Social Links</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-bs-toggle="tab">Contact Info</a></li>
                        </ul>

                        <div class="tab-content">
                            <!-- General Tab -->
                            <div class="tab-pane show active" id="general">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">App Name</label>
                                            <input type="text" class="form-control" name="app_name" value="{{ $settings['app_name'] ?? config('app.name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Contact Email</label>
                                            <input type="email" class="form-control" name="app_email" value="{{ $settings['app_email'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">App Logo (Dark/Standard)</label>
                                            <input type="file" class="form-control" name="app_logo">
                                            @if(isset($settings['app_logo']))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo" height="50">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">App Logo (White/Transparent)</label>
                                            <input type="file" class="form-control" name="app_logo_white">
                                            @if(isset($settings['app_logo_white']))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings['app_logo_white']) }}" alt="Logo White" height="50" style="background: #333; padding: 5px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Favicon</label>
                                            <input type="file" class="form-control" name="app_favicon">
                                            @if(isset($settings['app_favicon']))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings['app_favicon']) }}" alt="Favicon" height="32">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Tab -->
                            <div class="tab-pane" id="seo">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keywords</label>
                                            <textarea class="form-control" name="meta_keywords" rows="3">{{ $settings['meta_keywords'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links Tab -->
                            <div class="tab-pane" id="social">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="text" class="form-control" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Twitter/X URL</label>
                                            <input type="text" class="form-control" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="text" class="form-control" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">LinkedIn URL</label>
                                            <input type="text" class="form-control" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info Tab -->
                            <div class="tab-pane" id="contact">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" name="contact_address" rows="3">{{ $settings['contact_address'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Footer Copyright Text</label>
                                            <input type="text" class="form-control" name="footer_copyright" value="{{ $settings['footer_copyright'] ?? 'Copyright 2025 Dreams Rent. All Rights Reserved.' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
