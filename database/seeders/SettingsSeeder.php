<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'meta_title' => 'Website Title',
            'meta_description' => 'Website Description',
            'meta_keywords' => 'keyword1, keyword2',
            'marquee_text' => 'Welcome to our website',
            // ... data default lainnya
        ]);
    }
}
