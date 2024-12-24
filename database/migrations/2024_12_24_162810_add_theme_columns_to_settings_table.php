<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('primary_font')->nullable();
            $table->string('background_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'primary_color',
                'secondary_color',
                'primary_font',
                'background_color'
            ]);
        });
    }
};
