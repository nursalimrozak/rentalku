@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Community Image</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.rental-communities.update', $rentalCommunity->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Image</label>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $rentalCommunity->image) }}" width="100">
                    </div>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
