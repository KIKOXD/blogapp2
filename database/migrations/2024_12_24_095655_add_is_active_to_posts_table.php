<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('posts', 'is_active')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('user_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('posts', 'is_active')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
}; 