@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.settings') }}" class="text-blue-600 hover:text-blue-800">
            ← Kembali ke Pengaturan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Dashboard</h1>

        <form action="{{ route('admin.settings.dashboard.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Logo Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Logo Dashboard</h2>
                <div class="grid gap-4">
                    @if(isset($settings->dashboard_logo) && $settings->dashboard_logo)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $settings->dashboard_logo) }}" alt="Current Logo" class="h-20">
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Logo Baru
                        </label>
                        <input type="file" name="dashboard_logo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: PNG, JPG, GIF. Max: 2MB | Rekomendasi ukuran: 200 x 50 pixel</p>
                    </div>
                </div>
            </div>

            <!-- Favicon Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Favicon</h2>
                <div class="grid gap-4">
                    @if(isset($settings->favicon) && $settings->favicon)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Current Favicon" class="h-8">
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Favicon Baru
                        </label>
                        <input type="file" name="favicon" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: ICO, PNG. Max: 1MB | Rekomendasi ukuran: 32 x 32 pixel</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
