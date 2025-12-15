@extends('layouts.app')
@section('main-class', 'login-body')

@section('header-class', 'header-two')

@section('content')
<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <h1>Sign Up</h1>
                <p class="account-subtitle">We'll send a confirmation mail to your email.</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-block">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="" required value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="" required value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number" placeholder="" required value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-block">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input" name="password" placeholder="" required>
                            <span class="fas fa-eye toggle-password"></span>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="input-block">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <div class="pass-group">
                            <input type="password" class="form-control pass-input" name="password_confirmation" placeholder="" required>
                            <span class="fas fa-eye toggle-password"></span>
                        </div>
                    </div>
                    <div class="input-block">
                        <label class="custom_check">
                            <input type="checkbox" name="terms">
                            <span class="checkmark"></span> I have read and agree to <a href="terms-condition.html">Terms & Conditions</a>
                        </label>
                    </div>
                    <button class="btn btn-outline-light w-100 btn-size" type="submit">Sign Up</button>
                    <div class="text-center dont-have">Already have an account? <a href="{{ route('login') }}">Sign In</a></div>
                </form>							
            </div>
        </div>
    </div>
</div>
@endsection
