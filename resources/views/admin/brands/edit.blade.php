@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Brand</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
                </div>
                <div class="mb-3">
                    <label>Logo</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $brand->logo) }}" width="100">
                    </div>
                    <input type="file" name="logo" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
