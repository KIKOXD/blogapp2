<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->text('marquee_text')->nullable();
            $table->string('banner_1')->nullable();
            $table->string('banner_2')->nullable();
            $table->string('banner_3')->nullable();
            $table->string('favicon')->nullable();
            $table->text('footer_article')->nullable();
            $table->string('footer_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};