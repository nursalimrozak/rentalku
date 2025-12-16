@extends('layouts.admin')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

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
                    <textarea name="content" id="summernote" class="form-control" rows="8" required>{{ $article->content }}</textarea>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write your article content here...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush
@endsection
