@extends('layouts.admin')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between">
    <h4 class="page-title">Edit Seasonal Price</h4>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.seasonal-prices.update', $seasonalPrice->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $seasonalPrice->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price Increase Amount (Rp)</label>
                            <input type="number" class="form-control" name="price_increase" value="{{ $seasonalPrice->price_increase }}" required min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $seasonalPrice->start_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $seasonalPrice->end_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active" value="1" {{ $seasonalPrice->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.seasonal-prices.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
