<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

    public function landingUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'marquee_text' => 'nullable|string',
            'footer_article' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'whatsapp_link' => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'facebook_link' => 'nullable|string',
            'jackpot_text' => 'nullable|string|max:255',
        ]);

        $settings = Setting::firstOrNew();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $settings->logo = $request->file('logo')->store('settings', 'public');
        }

        // Handle Banner Uploads
        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile("banner_$i")) {
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
        $settings->jackpot_text = $request->jackpot_text;

        // Handle navbar buttons
        if ($request->has('button_text') && $request->has('button_url')) {
            $buttons = [];
            foreach ($request->button_text as $index => $text) {
                if (!empty($text)) {
                    $buttons[] = [
                        'text' => $text,
                        'url' => $request->button_url[$index] ?? '#'
                    ];
                }
            }
            $settings->navbar_buttons = !empty($buttons) ? json_encode($buttons) : null;
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

    public function dashboardUpdate(Request $request)
    {
        $request->validate([
            'dashboard_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        $settings = Setting::firstOrNew();

        // Handle Dashboard Logo Upload
        if ($request->hasFile('dashboard_logo')) {
            if ($settings->dashboard_logo) {
                Storage::disk('public')->delete($settings->dashboard_logo);
            }
            $settings->dashboard_logo = $request->file('dashboard_logo')->store('settings', 'public');
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $settings->favicon = $request->file('favicon')->store('settings', 'public');
        }

        $settings->save();

        return redirect()->route('admin.settings.dashboard')
            ->with('success', 'Pengaturan dashboard berhasil diperbarui');
    }

    public function seo()
    {
        $settings = Setting::first();
        return view('admin.settings.seo', compact('settings'));
    }

    public function seoUpdate(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'google_analytics_id' => 'nullable|string|max:20',
            'google_search_console' => 'nullable|string',
            'robots_txt' => 'nullable|string',
            'sitemap_xml' => 'nullable|string|url',
            'canonical_url' => 'nullable|string|url',
        ]);

        $settings = Setting::firstOrNew();

        $settings->meta_title = $request->meta_title;
        $settings->meta_description = $request->meta_description;
        $settings->meta_keywords = $request->meta_keywords;
        $settings->google_analytics_id = $request->google_analytics_id;
        $settings->google_search_console = $request->google_search_console;
        $settings->robots_txt = $request->robots_txt;
        $settings->sitemap_xml = $request->sitemap_xml;
        $settings->canonical_url = $request->canonical_url;

        $settings->save();

        // Generate robots.txt file
        if ($request->robots_txt) {
            File::put(public_path('robots.txt'), $request->robots_txt);
        }

        return redirect()->route('admin.settings.seo')
            ->with('success', 'Pengaturan SEO berhasil diperbarui');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('settings/images', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
        return response()->json(['error' => 'No image found.'], 400);
    }

    public function theme()
    {
        $settings = Setting::first();
        return view('admin.settings.theme', compact('settings'));
    }

    public function themeUpdate(Request $request)
    {
        $settings = Setting::firstOrNew();

        // Section colors
        $settings->background_color = $request->background_color;
        $settings->section_color = $request->section_color;

        // Card colors
        $settings->card_background_color = $request->card_background_color;
        $settings->card_text_primary_color = $request->card_text_primary_color;
        $settings->card_text_secondary_color = $request->card_text_secondary_color;
        $settings->card_button_color = $request->card_button_color;
        $settings->card_button_hover_color = $request->card_button_hover_color;
        $settings->card_date_color = $request->card_date_color;

        // Text colors
        $settings->text_primary_color = $request->text_primary_color;
        $settings->text_secondary_color = $request->text_secondary_color;
        $settings->text_accent_color = $request->text_accent_color;

        // Other colors
        $settings->primary_color = $request->primary_color;
        $settings->secondary_color = $request->secondary_color;
        $settings->primary_font = $request->primary_font;

        $settings->save();

        return redirect()->route('admin.settings.theme')
            ->with('success', 'Pengaturan theme berhasil diperbarui');
    }
}