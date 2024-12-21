@extends('customer.layouts.app')

@section('title', 'Bukti Jackpot')

@section('content')
    <main class="main-content">
        <h2 class="main-title">Bukti Jackpot Lunas AlexisTogel</h2>
        <div class="cards-container">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-image">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <div class="card-text">{!! Str::limit(strip_tags($post->description), 100) !!}</div>
                        <p class="card-detail">{{ $post->created_at->format('d M Y') }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="read-more">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            <div class="flex flex-col items-center gap-4">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $posts->firstItem() ?? 0 }} - {{ $posts->lastItem() ?? 0 }} dari {{ $totalPosts }} postingan
                </div>
                <div class="pagination">
                    {{ $posts->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
    <script>
    function toggleStatus(postId) {
        fetch(`/admin/posts/${postId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                notification.textContent = 'Status berhasil diubah';
                document.body.appendChild(notification);
                setTimeout(() => notification.remove(), 3000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            event.target.checked = !event.target.checked;
            alert('Gagal mengubah status');
        });
    }
    </script>
@endsection