@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Notification Container -->
    <div id="notification-container" class="fixed top-4 right-4 z-50"></div>

    <!-- Animated Title -->
    <div class="text-center mb-8">
        <h1 class="animate-title text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 text-transparent bg-clip-text bg-300% animate-gradient">
            Daftar Postingan
        </h1>
        <div class="w-32 h-1 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto mt-2 rounded-full animate-pulse"></div>
    </div>

    <!-- Bulk Actions -->
    <div class="mb-4 flex items-center gap-2">
        <select id="bulk-action" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Aksi Massal</option>
            <option value="delete">Hapus yang dipilih</option>
        </select>
        <button onclick="handleBulkAction()" 
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Terapkan
        </button>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <div class="w-2/3 flex gap-4">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex gap-2 w-full">
                <!-- Search Input -->
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari judul atau deskripsi..." 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                
                <!-- Author Filter -->
                <select name="author" 
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Status Filter -->
                <select name="status" 
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                <!-- Date Filter -->
                <div class="flex items-center gap-2">
                    <input 
                        type="date" 
                        name="start_date" 
                        value="{{ request('start_date') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    >
                    <span class="text-gray-500">s/d</span>
                    <input 
                        type="date" 
                        name="end_date" 
                        value="{{ request('end_date') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                <!-- Submit and Reset Buttons -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'author', 'status', 'start_date', 'end_date']))
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-64">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                        <div class="flex items-center gap-1 cursor-pointer" onclick="sortByDate()">
                            Tanggal
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($posts as $index => $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_posts[]" value="{{ $post->id }}" 
                                   class="post-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $post->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer ml-2">
                                <input type="checkbox" 
                                       class="sr-only peer" 
                                       {{ $post->is_active ? 'checked' : '' }}
                                       onchange="toggleStatus({{ $post->id }})">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-blue-600 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                            </label>
                        </td>
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
        
        <div class="mt-8 bg-white rounded-lg shadow-sm">
            <div class="flex flex-col items-center gap-4 py-4">
                <div class="text-sm text-gray-600 bg-gray-50 px-4 py-2 rounded-full">
                    Menampilkan {{ $posts->firstItem() ?? 0 }} - {{ $posts->lastItem() ?? 0 }} dari {{ $totalPosts }} postingan
                </div>
                <div class="pagination">
                    {{ $posts->withQueryString()->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/posts.js') }}"></script>
@endpush

@endsection