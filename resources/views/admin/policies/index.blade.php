@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Policies</h4>
        <a href="{{ route('admin.policies.create') }}" class="btn btn-primary">Add New Policy</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-center">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($policies as $policy)
                        <tr>
                            <td>{{ $policy->title }}</td>
                            <td>{{ Str::limit($policy->summary, 50) }}</td>
                            <td>
                                <a href="{{ route('admin.policies.edit', $policy->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.policies.destroy', $policy->id) }}" method="POST" class="d-inline">
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
