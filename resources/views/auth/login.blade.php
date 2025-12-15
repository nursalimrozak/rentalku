@extends('layouts.app')
@section('main-class', 'login-body')

@section('header-class', 'header-two')

@section('content')
<div class="login-wrapper">
    <div class="loginbox">
        <div class="login-auth">
            <div class="login-auth-wrap">
                <h1>Sign In</h1>
                <p class="account-subtitle">Access to our dashboard</p>
                
                <div class="alert alert-info">
                     <strong>Demo Accounts:</strong><br>
                     Super Admin: superadmin@rentalku.com / password<br>
                     Admin: admin@rentalku.com / password<br>
                     Penyewa: user@rentalku.com / password
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-block">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="" required value="{{ old('email') }}">
                        @error('email')
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
                        <a class="forgot-link" href="#">Forgot Password?</a>
                    </div>
                    <div class="input-block">
                        <label class="custom_check">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span> Remember my preference
                        </label>
                    </div>
                    <button class="btn btn-outline-light w-100 btn-size" type="submit">Sign In</button>
                    <div class="text-center dont-have">Don't have an account yet? <a href="{{ route('register') }}">Register</a></div>
                </form>							
            </div>
        </div>
    </div>
</div>
@endsection
