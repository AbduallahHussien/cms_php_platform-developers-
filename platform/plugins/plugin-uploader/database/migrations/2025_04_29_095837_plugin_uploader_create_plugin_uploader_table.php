<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('plugin_uploaders')) {
            Schema::create('plugin_uploaders', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('plugin_uploaders_translations')) {
            Schema::create('plugin_uploaders_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('plugin_uploaders_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'plugin_uploaders_id'], 'plugin_uploaders_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('plugin_uploaders');
        Schema::dropIfExists('plugin_uploaders_translations');
    }
};
