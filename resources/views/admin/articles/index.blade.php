@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Articles</h4>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Add New Article</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-center">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Published At</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category }}</td>
                            <td>{{ $article->published_at ? $article->published_at->format('Y-m-d') : '-' }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Image" width="50">
                            </td>
                            <td>
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
