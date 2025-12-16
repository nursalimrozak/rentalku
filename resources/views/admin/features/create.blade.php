@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Feature</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.features.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Icon Class (e.g., bx bxs-info-circle)</label>
                    <input type="text" name="icon" class="form-control" required>
                    <small class="form-text text-muted">Get icons from <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a></small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
