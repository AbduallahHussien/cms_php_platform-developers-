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
        if (!Schema::hasColumn('documentations', 'direction')) {
            Schema::table('documentations', function (Blueprint $table) {
                $table->enum('direction', ['LTR', 'RTL'])->default('LTR')->after('link');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('documentations', function (Blueprint $table) {
        //     $table->dropColumn(['direction']);
        // });
    }
};
