@extends('admin.layouts.master')

@section('content')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-200 bg-blue-600">
            <h2 class="text-2xl font-semibold text-white">Create New Post</h2>
        </div>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="mb-8">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-3">Title</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </div>

            <div class="mb-8">
                <label for="description" class="block text-lg font-medium text-gray-700 mb-3">Description</label>
                <textarea name="description" 
                          id="description" 
                          class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          required></textarea>
            </div>

            <div class="mb-8">
                <label for="image" class="block text-lg font-medium text-gray-700 mb-3">Image</label>
                <div class="mt-2">
                    <input type="file" 
                           name="image" 
                           id="image" 
                           class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           accept="image/*">
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.posts.index') }}" 
                   class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-base">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-base">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('description', {
        height: 400,
        removePlugins: 'elementspath',
        removeButtons: 'Source,Subscript,Superscript,Anchor,Styles,Specialchar'
    });
</script>
@endsection