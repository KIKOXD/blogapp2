@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.settings') }}" class="text-blue-600 hover:text-blue-800">
            ← Kembali ke Pengaturan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan SEO</h1>

        <form action="{{ route('admin.settings.seo.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Meta Title -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Meta Title</h2>
                <div>
                    <input type="text" name="meta_title" 
                           value="{{ old('meta_title', $settings->meta_title ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Judul yang akan muncul di hasil pencarian Google (50-60 karakter)</p>
                </div>
            </div>

            <!-- Meta Description -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Meta Description</h2>
                <div>
                    <textarea name="meta_description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Deskripsi yang akan muncul di hasil pencarian Google (150-160 karakter)</p>
                </div>
            </div>

            <!-- Meta Keywords -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Meta Keywords</h2>
                <div>
                    <input type="text" name="meta_keywords" 
                           value="{{ old('meta_keywords', $settings->meta_keywords ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Kata kunci yang dipisahkan dengan koma (contoh: togel, slot, casino)</p>
                </div>
            </div>

            <!-- Facebook Open Graph -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Facebook Open Graph</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            OG Title
                        </label>
                        <input type="text" name="og_title" 
                               value="{{ old('og_title', $settings->og_title ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Judul yang akan muncul saat dibagikan di Facebook</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            OG Description
                        </label>
                        <textarea name="og_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('og_description', $settings->og_description ?? '') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Deskripsi yang akan muncul saat dibagikan di Facebook</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            OG Image URL
                        </label>
                        <input type="text" name="og_image" 
                               value="{{ old('og_image', $settings->og_image ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">URL gambar yang akan muncul saat dibagikan di Facebook (Rekomendasi: 1200x630 pixels)</p>
                    </div>
                </div>
            </div>

            <!-- Twitter Card -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Twitter Card</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Twitter Card Type
                        </label>
                        <select name="twitter_card" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="summary" {{ (old('twitter_card', $settings->twitter_card ?? '') == 'summary') ? 'selected' : '' }}>Summary</option>
                            <option value="summary_large_image" {{ (old('twitter_card', $settings->twitter_card ?? '') == 'summary_large_image') ? 'selected' : '' }}>Summary Large Image</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Twitter Title
                        </label>
                        <input type="text" name="twitter_title" 
                               value="{{ old('twitter_title', $settings->twitter_title ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Twitter Description
                        </label>
                        <textarea name="twitter_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('twitter_description', $settings->twitter_description ?? '') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Twitter Image URL
                        </label>
                        <input type="text" name="twitter_image" 
                               value="{{ old('twitter_image', $settings->twitter_image ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">URL gambar untuk Twitter Card (Min: 144x144 pixels untuk Summary, 300x157 pixels untuk Summary Large Image)</p>
                    </div>
                </div>
            </div>

            <!-- Google Analytics -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Google Analytics ID</h2>
                <div>
                    <input type="text" name="google_analytics_id" 
                           value="{{ old('google_analytics_id', $settings->google_analytics_id ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">ID Google Analytics (contoh: UA-XXXXX-Y atau G-XXXXXXXX)</p>
                </div>
            </div>

            <!-- Google Search Console -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Google Search Console</h2>
                <div>
                    <input type="text" name="google_search_console" 
                           value="{{ old('google_search_console', $settings->google_search_console ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Meta tag verifikasi Google Search Console</p>
                </div>
            </div>

            <!-- Robots.txt -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Robots.txt Content</h2>
                <div>
                    <textarea name="robots_txt" rows="6"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono">{{ old('robots_txt', $settings->robots_txt ?? "User-agent: *\nAllow: /\nSitemap: " . url('sitemap.xml')) }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Isi file robots.txt</p>
                </div>
            </div>

            <!-- Sitemap XML -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Sitemap XML URL</h2>
                <div>
                    <input type="text" name="sitemap_xml" 
                           value="{{ old('sitemap_xml', $settings->sitemap_xml ?? url('sitemap.xml')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">URL sitemap.xml Anda</p>
                </div>
            </div>

            <!-- Canonical URL -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Canonical URL</h2>
                <div>
                    <input type="text" name="canonical_url" 
                           value="{{ old('canonical_url', $settings->canonical_url ?? url('/')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">URL utama website (untuk canonical & og:url)</p>
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