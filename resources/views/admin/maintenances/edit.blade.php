@extends('layouts.admin')

@section('content')
<div class="content me-0">
    <div class="mb-3">
        <a href="{{ route('admin.maintenances.index') }}" class="d-inline-flex align-items-center fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to List</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Maintenance</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.maintenances.update', $maintenance->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Car <span class="text-danger">*</span></label>
                        <select name="car_id" class="form-select" required>
                            <option value="">Select Car</option>
                            @foreach($cars as $car)
                                <option value="{{ $car->id }}" {{ old('car_id', $maintenance->car_id) == $car->id ? 'selected' : '' }}>{{ $car->name }} - {{ $car->license_plate }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $maintenance->date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estimated End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $maintenance->end_date?->format('Y-m-d')) }}">
                        <small class="text-muted">Optional. Auto-filled when status is completed.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="scheduled" {{ old('status', $maintenance->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="ongoing" {{ old('status', $maintenance->status) == 'ongoing' ? 'selected' : '' }}>In Progress (Ongoing)</option>
                            <option value="completed" {{ old('status', $maintenance->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cost (IDR) <span class="text-danger">*</span></label>
                        <input type="number" name="cost" class="form-control" value="{{ old('cost', $maintenance->cost) }}" min="0" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Proof of Payment</label>
                        @if($maintenance->proof_file_path)
                            <div class="mb-2">
                                <a href="{{ asset($maintenance->proof_file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="ti ti-file"></i> View Current Proof
                                </a>
                            </div>
                        @endif
                        <input type="file" name="proof_file_path" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        <small class="text-muted">Upload new proof to replace existing (JPG, PNG, PDF - Max 2MB)</small>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="3" required placeholder="Describe the maintenance required...">{{ old('description', $maintenance->description) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Maintenance</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
