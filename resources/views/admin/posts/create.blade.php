@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1 class="page-title">Create Post</h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Input Title -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- Input Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <!-- Input Image -->
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <!-- Button Group -->
        <div class="button-group">
            <button type="submit" class="btn btn-success">Save Post</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        height: 300,
        removePlugins: 'elementspath',
        removeButtons: 'Source,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
</script>
@endsection