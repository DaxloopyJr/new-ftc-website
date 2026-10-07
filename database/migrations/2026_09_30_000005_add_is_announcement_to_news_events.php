<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_events', function (Blueprint $t) {
            $t->boolean('is_announcement')->default(false)->after('location_sw');
        });
    }

    public function down(): void
    {
        Schema::table('news_events', function (Blueprint $t) {
            $t->dropColumn('is_announcement');
        });
    }
};
