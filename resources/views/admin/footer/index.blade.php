@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Footer Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Footer</li>
                </ul>
            </div>
            <div class="col-auto float-end ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_column"><i class="ti ti-plus"></i> Add Column</button>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($columns as $column)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">{{ $column->title }}</h5>
                    <div>
                        <button class="btn btn-sm btn-white" data-bs-toggle="modal" data-bs-target="#edit_column_{{ $column->id }}"><i class="ti ti-edit"></i></button>
                        <form action="{{ route('admin.footer.destroy', $column->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this column?')"><i class="ti ti-trash"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($column->links as $link)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ $link->url }}" target="_blank">{{ $link->label }}</a>
                            </div>
                            <form action="{{ route('admin.footer.links.destroy', $link->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0 p-0"><i class="ti ti-x"></i></button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-sm btn-light w-100" data-bs-toggle="modal" data-bs-target="#add_link_{{ $column->id }}">+ Add Link</button>
                </div>
            </div>
        </div>

        <!-- Edit Column Modal -->
        <div class="modal fade" id="edit_column_{{ $column->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Column</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.footer.update', $column->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $column->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" class="form-control" name="order" value="{{ $column->order }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Link Modal -->
        <div class="modal fade" id="add_link_{{ $column->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Link to {{ $column->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.footer.links.store', $column->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <input type="text" class="form-control" name="label" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">URL</label>
                                <input type="text" class="form-control" name="url" placeholder="e.g., https://google.com or /about-us" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" class="form-control" name="order" value="0" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Add Column Modal -->
<div class="modal fade" id="add_column">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Footer Column</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.footer.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
