@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Article</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" value="{{ $article->category }}" required>
                </div>
                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="8" required>{{ $article->content }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $article->image) }}" width="100">
                    </div>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Published At</label>
                    <input type="date" name="published_at" class="form-control" value="{{ $article->published_at ? $article->published_at->format('Y-m-d') : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
