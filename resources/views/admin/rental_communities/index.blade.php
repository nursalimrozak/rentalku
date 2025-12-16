@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Rental Community Images</h4>
        <a href="{{ route('admin.rental-communities.create') }}" class="btn btn-primary">Add New Image</a>
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
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($communities as $community)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $community->image) }}" alt="Image" width="100">
                            </td>
                            <td>
                                <a href="{{ route('admin.rental-communities.edit', $community->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.rental-communities.destroy', $community->id) }}" method="POST" class="d-inline">
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
