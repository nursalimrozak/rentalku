@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Brands</h4>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Add New Brand</a>
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
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo" width="50">
                            </td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
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
