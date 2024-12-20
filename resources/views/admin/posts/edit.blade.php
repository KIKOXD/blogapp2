@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1 class="page-title">Edit Post</h1>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Title -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <!-- Input Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="5"
                required>{{ $post->description }}</textarea>
        </div>

        <!-- Current Image Preview -->
        <div class="form-group">
            <label>Current Image:</label>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image"
                    style="max-width: 200px; margin: 10px 0;">
            @else
                <p>No image uploaded</p>
            @endif
        </div>

        <!-- Input New Image -->
        <div class="form-group">
            <label for="image">New Image (optional):</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <!-- Button Group -->
        <div class="button-group">
            <button type="submit" class="btn btn-success">Update Post</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<!-- CKEditor Script -->
<script>
    CKEDITOR.replace('description', {
        height: 300,
        removePlugins: 'elementspath',
        removeButtons: 'Source,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
</script>
@endsection