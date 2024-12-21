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
            <div class="flex justify-center">
                <div class="pagination">
                    {{ $posts->onEachSide(1)->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </main>
@endsection