<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('card_background_color')->nullable();
            $table->string('card_text_primary_color')->nullable();
            $table->string('card_text_secondary_color')->nullable();
            $table->string('card_button_color')->nullable();
            $table->string('card_date_color')->nullable();
            $table->string('card_button_hover_color')->nullable();
            $table->string('text_primary_color')->nullable();
            $table->string('text_secondary_color')->nullable();
            $table->string('text_accent_color')->nullable();

        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'card_background_color',
                'card_text_primary_color',
                'card_text_secondary_color',
                'card_button_color',
                'card_date_color',
                'card_button_hover_color',
                'text_primary_color',
                'text_secondary_color',
                'text_accent_color'
            ]);
        });
    }
};