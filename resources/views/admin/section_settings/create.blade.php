@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Section Setting</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.section-settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Key (Unique)</label>
                    <input type="text" name="key" class="form-control" required>
                    <small class="text-muted">e.g., banner, feature, car, brand, rental, testimonial, blog, faq</small>
                </div>
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
