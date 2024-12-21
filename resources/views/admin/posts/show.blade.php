@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.posts.index') }}" class="text-blue-600 hover:text-blue-800">
            ← Kembali ke Daftar Post
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
        
        <div class="mb-6">
            <p class="text-gray-600">
                Dibuat oleh: {{ $post->user ? $post->user->name : 'User tidak ditemukan' }} | 
                {{ $post->created_at->format('d M Y H:i') }}
            </p>
        </div>

        @if($post->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="max-w-2xl rounded-lg shadow-md">
            </div>
        @endif

        <div class="prose max-w-none">
            {!! $post->description !!}
        </div>

        <div class="mt-6 flex gap-2">
            <a href="{{ route('admin.posts.edit', $post->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Edit Post
            </a>
            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">
                    Hapus Post
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 