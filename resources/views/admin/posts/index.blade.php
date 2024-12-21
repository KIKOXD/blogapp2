@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Postingan</h1>

    <div class="mb-6 flex justify-between items-center">
        <div class="w-2/3 flex gap-4">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex gap-2 w-1/2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari judul atau deskripsi..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        Reset
                    </a>
                @endif
            </form>

            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex gap-2 w-1/2">
                <input 
                    type="date" 
                    name="start_date" 
                    value="{{ request('start_date') }}" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                <span class="flex items-center">-</span>
                <input 
                    type="date" 
                    name="end_date" 
                    value="{{ request('end_date') }}" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Filter
                </button>
                @if(request('start_date') || request('end_date'))
                    <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>
        
        <div>
            <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                + Create Post
            </a>
        </div>
    </div>

    <!-- Modal untuk gambar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50">
        <div class="max-w-[80%] max-h-[80%] relative">
            <button onclick="closeModal()" class="absolute -top-10 right-0 text-white text-xl font-bold hover:text-gray-300">&times; Close</button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-64">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $index => $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($post->image)
                                <div class="w-[160px] h-[90px] overflow-hidden rounded-lg cursor-pointer" 
                                     onclick="openModal('{{ asset('storage/' . $post->image) }}', '{{ $post->title }}')">
                                    <img src="{{ asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover hover:opacity-75 transition-opacity">
                                </div>
                            @else
                                <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="max-w-xs break-words">
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $post->title }}
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <div class="max-w-xs break-words">{!! \Illuminate\Support\Str::limit(strip_tags($post->description), 80, '...') !!}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $post->user ? $post->user->name : 'User tidak ditemukan' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" 
                                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition-colors" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-gray-200">
            @if ($posts->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center">
                    {{-- Previous Page Link --}}
                    @if ($posts->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            Previous
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            Previous
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                {{-- Array Of Links --}}
                                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                    @if ($page == $posts->currentPage())
                                        <span aria-current="page" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-gray-300">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition ease-in-out duration-150">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </div>

                    {{-- Next Page Link --}}
                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            Next
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            Next
                        </span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</div>

<script>
function openModal(imageSrc, imageAlt) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    modalImg.src = imageSrc;
    modalImg.alt = imageAlt;
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection