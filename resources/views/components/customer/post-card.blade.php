@props(['post'])

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