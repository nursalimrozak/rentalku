@extends('layouts.admin')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <h4 class="page-title">Add New Coupon</h4>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.vouchers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" name="code" required placeholder="e.g. SUMMER50" style="text-transform: uppercase;" value="{{ old('code') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (Rp)</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" name="value" required placeholder="e.g. 50000 or 10" min="0" value="{{ old('value') }}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Applicable For (Brand)</label>
                            <select class="form-select" name="brand">
                                <option value="all" {{ old('brand') == 'all' ? 'selected' : '' }}>All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}" {{ old('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Limit / Quota</label>
                            <input type="number" class="form-control" name="quota" required placeholder="e.g. 100" min="1" value="{{ old('quota', 100) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                        </div>
                        
                         <div class="col-md-12 mb-3">
                            <label class="form-label">Minimum Spend (Optional)</label>
                             <input type="number" class="form-control" name="minimum_spend" placeholder="0" min="0" value="{{ old('minimum_spend') }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea class="form-control" name="description" rows="2">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active" value="1" checked>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
