<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Basic SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Analytics & Verification
            $table->string('google_analytics_id')->nullable();
            $table->string('google_search_console')->nullable();

            // Technical SEO
            $table->text('robots_txt')->nullable();
            $table->string('sitemap_xml')->nullable();
            $table->string('canonical_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'google_analytics_id',
                'google_search_console',
                'robots_txt',
                'sitemap_xml',
                'canonical_url'
            ]);
        });
    }
};