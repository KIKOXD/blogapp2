<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            // SEO Settings
            'meta_title' => 'AlexisTogel - Situs Togel Online Terpercaya',
            'meta_description' => 'AlexisTogel adalah situs togel online terpercaya dengan hadiah terbesar dan pasaran togel terlengkap.',
            'meta_keywords' => 'togel online, togel terpercaya, alexis togel, situs togel',
            'google_analytics_id' => 'UA-XXXXXXXXX-X',
            'google_search_console' => 'google-site-verification-code',
            'canonical_url' => 'https://alexistogel.com',

            // Branding
            'favicon' => 'settings/favicon.ico',
            'logo' => 'settings/logo.png',

            // Header Settings
            'navbar_buttons' => json_encode([
                ['text' => 'Daftar Sekarang', 'url' => '#daftar'],
                ['text' => 'Login Member', 'url' => '#login']
            ]),

            // Marquee Text
            'marquee_text' => 'Selamat kepada pemenang jackpot: Rp24.857.400 | Selamat kepada pemenang jackpot: Rp50.000.000 | Main sekarang dan menangkan jackpot Anda!',

            // Banner Images
            'banner_1' => 'settings/1.jpg',
            'banner_2' => 'settings/2.jpg',
            'banner_3' => 'settings/3.jpg',

            // Social Media Links
            'whatsapp_link' => '6281234567890',
            'instagram_link' => 'alexistogel',
            'facebook_link' => 'https://facebook.com/alexistogel',

            // Footer Content
            'footer_article' => '<h1>AlexisTogel - Situs Togel Online Terpercaya</h1><p>AlexisTogel merupakan situs togel online terpercaya yang menyediakan berbagai pasaran togel terlengkap dengan hadiah terbesar...</p>',
            'footer_text' => '© 2024 AlexisTogel. Semua Hak Dilindungi.'
        ]);
    }
}
