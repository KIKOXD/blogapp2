<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function landing()
    {
        $settings = Setting::first();
        return view('admin.settings.landing', compact('settings'));
    }

    public function updateLanding(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'marquee_text' => 'nullable|string',
            'banner_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'footer_article' => 'nullable|string',
            'footer_text' => 'nullable|string|max:255',
            'whatsapp_link' => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'facebook_link' => 'nullable|string',
        ]);

        $settings = Setting::firstOrNew();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $settings->logo = $request->file('logo')->store('settings', 'public');
        }

        // Handle Banner Uploads
        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile("banner_$i")) {
                // Hapus banner lama jika ada
                if ($settings->{"banner_$i"}) {
                    Storage::disk('public')->delete($settings->{"banner_$i"});
                }
                $settings->{"banner_$i"} = $request->file("banner_$i")->store('settings/banners', 'public');
            }
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $settings->favicon = $request->file('favicon')->store('settings', 'public');
        }

        // Update text fields
        $settings->marquee_text = $request->marquee_text;
        $settings->footer_article = $request->footer_article;
        $settings->footer_text = $request->footer_text;
        $settings->whatsapp_link = $request->whatsapp_link;
        $settings->instagram_link = $request->instagram_link;
        $settings->facebook_link = $request->facebook_link;

        // Handle navbar buttons
        if ($request->has('button_text') && $request->has('button_url')) {
            $buttons = [];
            foreach ($request->button_text as $index => $text) {
                if (!empty($text)) { // Hanya simpan jika ada teks tombol
                    $buttons[] = [
                        'text' => $text,
                        'url' => $request->button_url[$index] ?? '#'
                    ];
                }
            }
            $settings->navbar_buttons = !empty($buttons) ? json_encode($buttons) : null;
        } else {
            // Set default buttons jika tidak ada input
            $settings->navbar_buttons = json_encode([
                ['text' => 'Daftar Sekarang', 'url' => '#'],
                ['text' => 'Login Member', 'url' => '#']
            ]);
        }

        $settings->save();

        return redirect()->route('admin.settings.landing')
            ->with('success', 'Pengaturan landing page berhasil diperbarui');
    }

    public function dashboard()
    {
        $settings = Setting::first();
        return view('admin.settings.dashboard', compact('settings'));
    }
}