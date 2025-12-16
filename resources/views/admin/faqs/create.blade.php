@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add FAQ</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Question</label>
                    <input type="text" name="question" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Answer</label>
                    <textarea name="answer" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
