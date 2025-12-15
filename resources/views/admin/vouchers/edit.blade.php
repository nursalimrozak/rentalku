@extends('layouts.admin')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <h4 class="page-title">Edit Coupon</h4>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.vouchers.update', $voucher->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" name="code" required value="{{ $voucher->code }}" style="text-transform: uppercase;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type" required>
                                <option value="fixed" {{ $voucher->type == 'fixed' ? 'selected' : '' }}>Fixed Amount (Rp)</option>
                                <option value="percent" {{ $voucher->type == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" name="value" required value="{{ $voucher->value }}" min="0">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Applicable For (Brand)</label>
                            <select class="form-select" name="brand">
                                <option value="all" {{ $voucher->brand == null ? 'selected' : '' }}>All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}" {{ $voucher->brand == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Limit / Quota</label>
                            <input type="number" class="form-control" name="quota" required value="{{ $voucher->quota }}" min="1">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $voucher->start_date ? $voucher->start_date->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $voucher->end_date ? $voucher->end_date->format('Y-m-d') : '' }}">
                        </div>
                        
                         <div class="col-md-12 mb-3">
                            <label class="form-label">Minimum Spend (Optional)</label>
                             <input type="number" class="form-control" name="minimum_spend" value="{{ $voucher->minimum_spend }}" min="0">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea class="form-control" name="description" rows="2">{{ $voucher->description }}</textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active" value="1" {{ $voucher->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.vouchers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
