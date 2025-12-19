@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <h2 class="breadcrumb-title" style="float: none; display: block; margin-bottom: 10px;">{{ $policy->title }}</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb d-inline-block">
                    <ol class="breadcrumb justify-content-center" style="margin: 0; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Policy</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<section class="section about-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">
                    <div class="about-info">
                        <div class="mt-4">
                            {!! $policy->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
