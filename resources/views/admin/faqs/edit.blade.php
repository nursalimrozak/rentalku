@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit FAQ</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Question</label>
                    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                </div>
                <div class="mb-3">
                    <label>Answer</label>
                    <textarea name="answer" class="form-control" rows="4" required>{{ $faq->answer }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
