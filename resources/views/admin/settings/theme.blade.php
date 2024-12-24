@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.settings') }}" class="text-blue-600 hover:text-blue-800">
            ← Kembali ke Pengaturan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Theme</h1>

        <form action="{{ route('admin.settings.theme.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Primary Color -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Warna Utama</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Warna Primary
                    </label>
                    <input type="color" name="primary_color"
                        value="{{ old('primary_color', $settings->primary_color ?? '#003f7f') }}" class="h-10 w-20">
                    <p class="text-sm text-gray-500 mt-1">Warna utama untuk tombol dan elemen penting</p>
                </div>
            </div>

            <!-- Secondary Color -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Warna Sekunder</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Pilih Warna Secondary
                    </label>
                    <input type="color" name="secondary_color"
                        value="{{ old('secondary_color', $settings->secondary_color ?? '#ff6b6b') }}" class="h-10 w-20">
                    <p class="text-sm text-gray-500 mt-1">Warna sekunder untuk aksen dan highlight</p>
                </div>
            </div>

            <!-- Font Settings -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Pengaturan Font</h2>
                <div class="grid gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Font Utama
                        </label>
                        <select name="primary_font" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="Inter" {{ ($settings->primary_font ?? '') == 'Inter' ? 'selected' : '' }}>Inter
                            </option>
                            <option value="Roboto" {{ ($settings->primary_font ?? '') == 'Roboto' ? 'selected' : '' }}>
                                Roboto</option>
                            <option value="Open Sans" {{ ($settings->primary_font ?? '') == 'Open Sans' ? 'selected' : '' }}>Open Sans</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section Colors -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Warna Section</h2>
                <div class="grid gap-4">
                    <!-- Background Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Background
                        </label>
                        <input type="color" name="background_color"
                            value="{{ old('background_color', $settings->background_color ?? '#f3f4f6') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna background untuk halaman frontend</p>
                    </div>

                    <!-- Section Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Section (Navbar, Marquee, Footer)
                        </label>
                        <input type="color" name="section_color"
                            value="{{ old('section_color', $settings->section_color ?? '#ffffff') }}" class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk navbar, marquee text, dan footer</p>
                    </div>
                </div>
            </div>

            <!-- Card Colors -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Warna Kartu</h2>
                <div class="grid gap-4">
                    <!-- Card Background Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Background Kartu
                        </label>
                        <input type="color" name="card_background_color"
                            value="{{ old('card_background_color', $settings->card_background_color ?? '#ffffff') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna latar belakang kartu</p>
                    </div>

                    <!-- Card Primary Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Utama Kartu
                        </label>
                        <input type="color" name="card_text_primary_color"
                            value="{{ old('card_text_primary_color', $settings->card_text_primary_color ?? '#333333') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk judul kartu</p>
                    </div>

                    <!-- Card Secondary Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Sekunder Kartu
                        </label>
                        <input type="color" name="card_text_secondary_color"
                            value="{{ old('card_text_secondary_color', $settings->card_text_secondary_color ?? '#666666') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk deskripsi kartu</p>
                    </div>

                    <!-- Card Button Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Tombol Kartu
                        </label>
                        <input type="color" name="card_button_color"
                            value="{{ old('card_button_color', $settings->card_button_color ?? '#2563eb') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk tombol pada kartu</p>
                    </div>

                    <!-- Card Button Hover Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Hover Tombol Kartu
                        </label>
                        <input type="color" name="card_button_hover_color"
                            value="{{ old('card_button_hover_color', $settings->card_button_hover_color ?? '#1d4ed8') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna tombol saat dihover</p>
                    </div>

                    <!-- Card Date Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Tanggal Kartu
                        </label>
                        <input type="color" name="card_date_color"
                            value="{{ old('card_date_color', $settings->card_date_color ?? '#999999') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk teks tanggal pada kartu</p>
                    </div>
                </div>
            </div>

            <!-- Text Colors -->
            <div class="mb-8 border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Warna Teks</h2>
                <div class="grid gap-4">
                    <!-- Primary Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Utama
                        </label>
                        <input type="color" name="text_primary_color"
                            value="{{ old('text_primary_color', $settings->text_primary_color ?? '#333333') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk teks utama (marquee, footer, dll)</p>
                    </div>

                    <!-- Secondary Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Sekunder
                        </label>
                        <input type="color" name="text_secondary_color"
                            value="{{ old('text_secondary_color', $settings->text_secondary_color ?? '#666666') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk teks sekunder</p>
                    </div>

                    <!-- Accent Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Warna Teks Aksen
                        </label>
                        <input type="color" name="text_accent_color"
                            value="{{ old('text_accent_color', $settings->text_accent_color ?? '#2563eb') }}"
                            class="h-10 w-20">
                        <p class="text-sm text-gray-500 mt-1">Warna untuk teks yang disorot (pagination, dll)</p>
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