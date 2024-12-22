@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Settings</h1>
        <div class="w-32 h-1 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto mt-2 rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Landing Page Settings Card -->
        <a href="{{ route('admin.settings.landing') }}" 
           class="bg-white rounded-lg shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 ml-4">Set Up Landing Page</h2>
            </div>
            <p class="text-gray-600">Konfigurasi tampilan dan konten halaman landing website Anda.</p>
            <div class="mt-4 flex justify-end">
                <span class="text-blue-600 flex items-center">
                    Kelola 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- Dashboard Settings Card -->
        <a href="{{ route('admin.settings.dashboard') }}" 
           class="bg-white rounded-lg shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 ml-4">Set Up Dashboard</h2>
            </div>
            <p class="text-gray-600">Sesuaikan tampilan dan pengaturan dashboard admin Anda.</p>
            <div class="mt-4 flex justify-end">
                <span class="text-purple-600 flex items-center">
                    Kelola 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <!-- SEO Settings Card -->
        <a href="{{ route('admin.settings.seo') }}" 
           class="bg-white rounded-lg shadow-lg p-6 transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 ml-4">Set Up SEO</h2>
            </div>
            <p class="text-gray-600">Optimasi SEO website untuk meningkatkan visibilitas di mesin pencari.</p>
            <div class="mt-4 flex justify-end">
                <span class="text-green-600 flex items-center">
                    Kelola 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>
    </div>
</div>
@endsection 