@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Testimonial</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Rating (1-5)</label>
                    <input type="number" name="rating" class="form-control" min="1" max="5" required>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
