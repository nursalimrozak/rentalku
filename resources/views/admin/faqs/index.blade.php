@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>FAQs</h4>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Add New FAQ</a>
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
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $faq->question }}</td>
                            <td>{{ Str::limit($faq->answer, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="d-inline">
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
