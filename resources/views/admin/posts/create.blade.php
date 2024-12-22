@extends('admin.layouts.master')

@section('content')
<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.posts.index') }}" 
           class="text-blue-600 hover:text-blue-800 transition-colors duration-300 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Daftar Post
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">Create New Post</h1>

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative transition-all duration-300">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div class="transition-all duration-300 transform hover:-translate-y-1">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                           value="{{ old('title') }}" required>
                </div>

                <div class="transition-all duration-300 transform hover:-translate-y-1">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                              required>{{ old('description') }}</textarea>
                </div>

                <div class="transition-all duration-300 transform hover:-translate-y-1">
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                    <input type="file" name="image" id="image" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-300"
                           accept="image/*" required>
                </div>

                <div class="flex justify-end space-x-4 pt-6">
                    <button type="button" onclick="window.location.href='{{ route('admin.posts.index') }}'" 
                            class="px-6 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transform hover:-translate-y-1 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Post
                    </button>
                </div>
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

<script>
document.getElementById('createPostForm').addEventListener('submit', function(e) {
    e.preventDefault();
    this.submit();
});
</script>
@endsection