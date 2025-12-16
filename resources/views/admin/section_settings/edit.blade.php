@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="page-header">
        <h4>Edit Section Setting</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.section-settings.update', $sectionSetting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Key (Unique)</label>
                    <input type="text" name="key" class="form-control" value="{{ $sectionSetting->key }}" required readonly>
                    <small class="text-muted">Key cannot be changed.</small>
                </div>
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $sectionSetting->title }}" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $sectionSetting->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    @if($sectionSetting->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $sectionSetting->image) }}" width="100">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
