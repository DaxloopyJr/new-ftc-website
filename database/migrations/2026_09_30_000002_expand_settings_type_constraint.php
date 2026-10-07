<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Expand the settings.type CHECK constraint so 'color' and 'select' are allowed
        if (Schema::hasTable('settings') && DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE settings DROP CONSTRAINT IF EXISTS settings_type_check');
            DB::statement("ALTER TABLE settings ADD CONSTRAINT settings_type_check CHECK (type IN ('text','textarea','file','boolean','number','color','select'))");
        }

        // Appearance settings (admin > Settings > Appearance)
        if (Schema::hasTable('settings')) {
            $appearance = [
                ['key' => 'appearance_primary_color', 'value' => '#1B5E20', 'group' => 'appearance', 'type' => 'color', 'label' => 'Primary Color'],
                ['key' => 'appearance_accent_color', 'value' => '#f5b301', 'group' => 'appearance', 'type' => 'color', 'label' => 'Accent Color'],
                ['key' => 'appearance_skin', 'value' => 'light', 'group' => 'appearance', 'type' => 'select', 'label' => 'Website Skin'],
            ];
            foreach ($appearance as $row) {
                if (!DB::table('settings')->where('key', $row['key'])->exists()) {
                    DB::table('settings')->insert($row);
                }
            }
        }
    }

    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['appearance_primary_color', 'appearance_accent_color', 'appearance_skin'])->delete();

        if (Schema::hasTable('settings') && DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE settings DROP CONSTRAINT IF EXISTS settings_type_check');
            DB::statement("ALTER TABLE settings ADD CONSTRAINT settings_type_check CHECK (type IN ('text','textarea','file','boolean','number'))");
        }
    }
};
