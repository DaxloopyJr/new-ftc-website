<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_events', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->text('excerpt_sw')->nullable()->after('excerpt');
            $t->longText('content_sw')->nullable()->after('content');
            $t->string('location_sw')->nullable()->after('location');
        });
        Schema::table('pages', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->longText('content_sw')->nullable()->after('content');
        });
        Schema::table('publications', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->text('description_sw')->nullable()->after('description');
        });
        Schema::table('info_library', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->text('description_sw')->nullable()->after('description');
        });
        Schema::table('hero_slides', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->string('subtitle_sw')->nullable()->after('subtitle');
            $t->string('button_text_sw', 100)->nullable()->after('button_text');
        });
        Schema::table('team_members', function (Blueprint $t) {
            $t->string('name_sw')->nullable()->after('name');
            $t->string('title_sw')->nullable()->after('title');
            $t->string('designation_sw')->nullable()->after('designation');
            $t->text('bio_sw')->nullable()->after('bio');
        });
        Schema::table('advertisements', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
        });
        Schema::table('media_gallery', function (Blueprint $t) {
            $t->string('title_sw')->nullable()->after('title');
            $t->text('description_sw')->nullable()->after('description');
        });
        Schema::table('settings', function (Blueprint $t) {
            $t->text('value_sw')->nullable()->after('value');
        });
    }

    public function down(): void
    {
        $cols = [
            'news_events'    => ['title_sw', 'excerpt_sw', 'content_sw', 'location_sw'],
            'pages'          => ['title_sw', 'content_sw'],
            'publications'   => ['title_sw', 'description_sw'],
            'info_library'   => ['title_sw', 'description_sw'],
            'hero_slides'    => ['title_sw', 'subtitle_sw', 'button_text_sw'],
            'team_members'   => ['name_sw', 'title_sw', 'designation_sw', 'bio_sw'],
            'advertisements' => ['title_sw'],
            'media_gallery'  => ['title_sw', 'description_sw'],
            'settings'       => ['value_sw'],
        ];
        foreach ($cols as $table => $columns) {
            Schema::table($table, fn (Blueprint $t) => $t->dropColumn($columns));
        }
    }
};
