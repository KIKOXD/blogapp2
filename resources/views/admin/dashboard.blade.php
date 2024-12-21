@extends('admin.layouts.master')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-12">Dashboard Admin</h1>
    
    <div class="max-w-4xl mx-auto">
        <!-- Cards -->
        <div class="grid grid-cols-2 gap-6 mb-8">
            <!-- Card Total Users -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Total Posts -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg p-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Posts</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $totalPosts }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white shadow-lg rounded-lg mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Users</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentUsers as $user)
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <div class="ml-auto text-sm text-gray-500">
                                Joined {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="bg-white shadow-lg rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Recent Posts</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentPosts as $post)
                    <div class="px-6 py-4">
                        <div class="flex items-center">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" 
                                     alt="{{ $post->title }}" 
                                     class="h-12 w-12 object-cover rounded">
                            @else
                                <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ $post->title }}</p>
                                <p class="text-sm text-gray-500">{{ Str::limit(strip_tags($post->description), 50) }}</p>
                            </div>
                            <div class="ml-auto text-sm text-gray-500">
                                Posted {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
