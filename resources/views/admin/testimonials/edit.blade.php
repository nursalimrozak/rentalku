@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Testimonial</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $testimonial->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $testimonial->location }}" required>
                </div>
                <div class="mb-3">
                    <label>Rating (1-5)</label>
                    <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $testimonial->rating }}" required>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="4" required>{{ $testimonial->content }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Photo</label>
                    @if($testimonial->photo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" width="50" class="rounded-circle">
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
