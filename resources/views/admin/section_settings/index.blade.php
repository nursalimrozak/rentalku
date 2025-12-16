@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Section Settings</h4>
        <a href="{{ route('admin.section-settings.create') }}" class="btn btn-primary">Add New Setting</a>
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
                            <th>Key</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td>{{ $setting->key }}</td>
                            <td>{{ $setting->title }}</td>
                            <td>{{ Str::limit($setting->description, 50) }}</td>
                            <td>
                                @if($setting->image)
                                    <img src="{{ asset('storage/' . $setting->image) }}" alt="Image" width="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.section-settings.edit', $setting->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.section-settings.destroy', $setting->id) }}" method="POST" class="d-inline">
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
