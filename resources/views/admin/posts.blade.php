@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Create New Post</h2>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="form-group">
            <label for="title" class="block text-lg font-semibold">Title</label>
            <input type="text" name="title" id="title" class="form-input mt-2 w-full border-gray-300 rounded-lg shadow-sm" placeholder="Enter post title" required>
        </div>

        <div class="form-group">
            <label for="description" class="block text-lg font-semibold">Description</label>
            <textarea name="description" id="description" class="form-input mt-2 w-full border-gray-300 rounded-lg shadow-sm" placeholder="Enter post description"></textarea>
        </div>

        <div class="form-group">
            <label for="image" class="block text-lg font-semibold">Upload Image</label>
            <input type="file" name="image" id="image" class="form-input mt-2 w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
            Submit
        </button>
    </form>
</div>
<script>
    CKEDITOR.replace('description');
</script>

@endsection
