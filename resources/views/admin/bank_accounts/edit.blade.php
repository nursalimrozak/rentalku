@extends('layouts.admin')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h4 class="mb-1">Edit Bank Account</h4>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.bank-accounts.index') }}">Bank Accounts</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
        <div class="mb-2">
            <a href="{{ route('admin.bank-accounts.index') }}" class="btn btn-secondary d-flex align-items-center"><i class="ti ti-arrow-left me-2"></i>Back</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.bank-accounts.update', $bankAccount->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bank Name <span class="text-danger">*</span></label>
                    <input type="text" name="bank_name" class="form-control" value="{{ $bankAccount->bank_name }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Number <span class="text-danger">*</span></label>
                    <input type="text" name="account_number" class="form-control" value="{{ $bankAccount->account_number }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Holder Name <span class="text-danger">*</span></label>
                    <input type="text" name="account_holder" class="form-control" value="{{ $bankAccount->account_holder }}" required>
                </div>

                <div class="col-md-6 mb-3 align-self-center">
                    <div class="form-check form-switch mt-4">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $bankAccount->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Bank Account</button>
            </div>
        </form>
    </div>
</div>
@endsection
