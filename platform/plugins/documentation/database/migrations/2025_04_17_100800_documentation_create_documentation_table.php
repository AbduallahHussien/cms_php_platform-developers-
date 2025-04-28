<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('documentations')) {
            Schema::create('documentations', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('documentations_translations')) {
            Schema::create('documentations_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('documentations_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'documentations_id'], 'documentations_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('documentations');
        Schema::dropIfExists('documentations_translations');
    }
};
