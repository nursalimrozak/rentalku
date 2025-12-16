@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Rental Steps</h4>
        <a href="{{ route('admin.rental-steps.create') }}" class="btn btn-primary">Add New Step</a>
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
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentalSteps as $step)
                        <tr>
                            <td>{{ $step->title }}</td>
                            <td>{{ Str::limit($step->description, 50) }}</td>
                            <td><i class="{{ $step->icon }}"></i> ({{ $step->icon }})</td>
                            <td>
                                <a href="{{ route('admin.rental-steps.edit', $step->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.rental-steps.destroy', $step->id) }}" method="POST" class="d-inline">
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
