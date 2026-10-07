<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('info_library', function (Blueprint $t) {
            $t->date('registration_date')->nullable()->after('decision_date');
            $t->string('case_type', 30)->nullable()->after('registration_date');   // appeal / application
            $t->string('status', 30)->nullable()->after('case_type');              // Hearing / Mention / Judgement
            $t->string('issue', 255)->nullable()->after('status');                 // e.g. Stay of Execution
        });
    }

    public function down(): void
    {
        Schema::table('info_library', function (Blueprint $t) {
            $t->dropColumn(['registration_date', 'case_type', 'status', 'issue']);
        });
    }
};
