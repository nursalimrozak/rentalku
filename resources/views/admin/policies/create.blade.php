@extends('layouts.admin')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
<div class="content">
    <div class="page-header d-flex align-items-center justify-content-between">
        <h4>Add New Policy</h4>
        <a href="{{ route('admin.policies.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('admin.policies.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g., Cancellation Charges" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Summary (Shown on card)</label>
                    <textarea name="summary" class="form-control" rows="2" placeholder="Short description..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content (Full details)</label>
                    <textarea name="content" id="summernote" class="form-control" rows="10" placeholder="Full policy content..." required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon Class (Optional)</label>
                        <input type="text" name="icon" class="form-control" placeholder="e.g., ti ti-file-text">
                        <small class="text-muted">Use Tabler icons (ti ti-*)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link Text</label>
                        <input type="text" name="link_text" class="form-control" value="Know More" placeholder="e.g., View Details">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save Policy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write full policy details here...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush
@endsection
