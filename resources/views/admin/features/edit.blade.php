@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Feature</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.features.update', $feature->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $feature->title }}" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ $feature->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Icon Class (e.g., bx bxs-info-circle)</label>
                    <input type="text" name="icon" class="form-control" value="{{ $feature->icon }}" required>
                    <small class="form-text text-muted">Get icons from <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
