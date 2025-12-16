@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">500 Server Error</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">500 Server Error</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="error-box-pages">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="error-box text-center py-5">
                        <h1 class="display-1 fw-bold text-danger">500</h1>
                        <h3 class="h2 mb-3"><i class="fa-solid fa-server text-danger me-2"></i> Terjadi Kesalahan Server</h3>
                        <p class="h5 font-weight-normal mb-4">Maaf, terjadi kesalahan internal pada server kami. Silakan coba beberapa saat lagi.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-rotate-right me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
