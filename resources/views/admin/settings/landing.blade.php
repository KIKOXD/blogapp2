@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Include Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <div class="mb-6">
        <a href="{{ route('admin.settings') }}" class="text-blue-600 hover:text-blue-800">
            ← Kembali ke Pengaturan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Landing Page</h1>

        <form action="{{ route('admin.settings.landing.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Logo Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Logo Website</h2>
                <div class="grid gap-4">
                    @if(isset($settings->logo) && $settings->logo)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo" class="h-20">
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Logo Baru
                        </label>
                        <input type="file" name="logo" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: PNG, JPG, GIF. Max: 2MB | Rekomendasi ukuran: 540 x 180 pixel</p>
                    </div>
                </div>
            </div>

            <!-- Navbar Buttons Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Tombol Navbar</h2>
                
                <!-- Dynamic Buttons -->
                <div id="button-container">
                    @php
                        $buttons = isset($settings->navbar_buttons) ? json_decode($settings->navbar_buttons) : [
                            (object)['text' => 'Daftar Sekarang', 'url' => '#'],
                            (object)['text' => 'Login Member', 'url' => '#']
                        ];
                    @endphp
                    
                    @foreach($buttons as $index => $button)
                        <div class="mb-4 button-group flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tombol {{ $index + 1 }}
                                </label>
                                <input type="text" name="button_text[]" value="{{ $button->text }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Teks tombol">
                                <input type="text" name="button_url[]" value="{{ $button->url }}"
                                       class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="URL tombol (contoh: https://example.com)">
                            </div>
                            <button type="button" class="remove-button text-red-600 hover:text-red-800 mt-8">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-button" 
                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                    + Tambah Tombol
                </button>
            </div>

            <!-- Marquee Text Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Text Berjalan (Marquee)</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Isi Text Berjalan
                    </label>
                    <textarea name="marquee_text" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('marquee_text', $settings->marquee_text ?? '') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Pisahkan setiap pengumuman dengan tanda |</p>
                </div>
            </div>

            <!-- Jackpot Text Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Text Jackpot Customer</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Text Jackpot
                    </label>
                    <textarea name="jackpot_text" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('jackpot_text', $settings->jackpot_text ?? 'BUKTI JACKPOT LUNAS') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Text yang akan muncul di bagian jackpot customer landing page</p>
                </div>
            </div>

            <!-- Banner Slider Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Banner Slider</h2>
                <div class="grid gap-4">
                    @for($i = 1; $i <= 3; $i++)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Banner {{ $i }}
                            </label>
                            @if(isset($settings->{"banner_$i"}) && $settings->{"banner_$i"})
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $settings->{"banner_$i"}) }}" 
                                         alt="Banner {{ $i }}" class="h-32 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="banner_{{ $i }}" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-sm text-gray-500 mt-1">Format: PNG, JPG, GIF. Max: 2MB. Rekomendasi ukuran: 1920 x 600 pixel</p>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Favicon Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Favicon</h2>
                <div class="grid gap-4">
                    @if(isset($settings->favicon) && $settings->favicon)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings->favicon) }}" 
                                 alt="Current Favicon" class="h-8">
                        </div>
                    @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Favicon Baru
                        </label>
                        <input type="file" name="favicon" accept="image/x-icon,image/png"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Format: ICO, PNG. Max: 1MB. Rekomendasi ukuran: 32 x 32 pixel</p>
                    </div>
                </div>
            </div>

            <!-- Footer Article Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Artikel Footer</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Artikel
                    </label>
                    <textarea id="summernote" name="footer_article">{{ old('footer_article', $settings->footer_article ?? '') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Gunakan tools formatting untuk mengatur tampilan artikel (Heading, Link, dll)
                    </p>
                </div>
            </div>

            <!-- Footer Text Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Text Footer</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Copyright Text
                    </label>
                    <input type="text" name="footer_text" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('footer_text', $settings->footer_text ?? '') }}">
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Social Media Links</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            WhatsApp
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <input type="text" name="whatsapp_link" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('whatsapp_link', $settings->whatsapp_link ?? '') }}"
                                   placeholder="Contoh: 628123456789">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Instagram
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                                <i class="fab fa-instagram"></i>
                            </span>
                            <input type="text" name="instagram_link" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('instagram_link', $settings->instagram_link ?? '') }}"
                                   placeholder="Username Instagram">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Facebook
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-gray-500 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md">
                                <i class="fab fa-facebook"></i>
                            </span>
                            <input type="text" name="facebook_link" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   value="{{ old('facebook_link', $settings->facebook_link ?? '') }}"
                                   placeholder="URL Facebook">
                        </div>
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

@push('scripts')
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        plugins: 'link lists headings code table',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | link | removeformat',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis artikel footer di sini...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            styleTags: [
                'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ]
        });
    });
</script>
<script>
document.getElementById('add-button').addEventListener('click', function() {
    const container = document.getElementById('button-container');
    const buttonCount = container.getElementsByClassName('button-group').length;
    
    const newButton = document.createElement('div');
    newButton.className = 'mb-4 button-group flex gap-4';
    newButton.innerHTML = `
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Tombol ${buttonCount + 1}
            </label>
            <input type="text" name="button_text[]" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Teks tombol">
            <input type="text" name="button_url[]"
                   class="mt-2 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="URL tombol (contoh: https://example.com)">
        </div>
        <button type="button" class="remove-button text-red-600 hover:text-red-800 mt-8">
            <i class="fas fa-trash"></i>
        </button>
    `;
    
    container.appendChild(newButton);
});

document.getElementById('button-container').addEventListener('click', function(e) {
    if (e.target.closest('.remove-button')) {
        e.target.closest('.button-group').remove();
    }
});
</script>
@endpush
