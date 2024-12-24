@extends('customer.layouts.app')

@section('title', 'Bukti Jackpot')

@section('content')
<main class="main-content">
    <!-- Jackpot Text Section -->
    <x-customer.jackpot-text :settings="$settings" />
    <div class="cards-container">
        @foreach ($posts as $post)
            <x-customer.post-card :post="$post" />
        @endforeach
    </div>
    <x-customer.pagination :posts="$posts" :totalPosts="$totalPosts" />
</main>

@push('scripts')
    <script src="{{ asset('js/customer/posts.js') }}"></script>
@endpush
@endsection