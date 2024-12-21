@extends('customer.layouts.app')

@section('title', $post->title)

@section('content')
    <main class="main-content">
        <div class="post-container">
            <div class="post-detail">
                <h1 class="post-title">{{ $post->title }}</h1>
                <div class="post-meta">
                    <span class="post-date">{{ $post->created_at->format('d M Y') }}</span>
                </div>
                <div class="post-image">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    @endif
                </div>
                <div class="post-content">
                    {!! $post->description !!}
                </div>
                <div class="post-navigation">
                    <a href="{{ route('home') }}" class="back-button">← Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </main>
@endsection