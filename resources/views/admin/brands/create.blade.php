@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Add Brand</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Logo</label>
                    <input type="file" name="logo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
