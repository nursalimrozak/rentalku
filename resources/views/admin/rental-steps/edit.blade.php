@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Rental Step</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.rental-steps.update', $rentalStep->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $rentalStep->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $rentalStep->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon Class (Bootstrap Icons)</label>
                    <input type="text" name="icon" class="form-control" value="{{ $rentalStep->icon }}" required>
                    <small class="text-muted">Use <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a> classes.</small>
                </div>
                <button type="submit" class="btn btn-primary">Update Step</button>
                <a href="{{ route('admin.rental-steps.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
