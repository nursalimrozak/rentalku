@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Article</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="8" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Published At</label>
                    <input type="date" name="published_at" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
