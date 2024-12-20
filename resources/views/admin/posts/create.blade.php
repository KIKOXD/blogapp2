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

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Save Post</button>
    </form>
</div>

<!-- CKEditor Script -->
<script>
    CKEDITOR.replace('description');
</script>
@endsection
