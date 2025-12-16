@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Community Image</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.rental-communities.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
