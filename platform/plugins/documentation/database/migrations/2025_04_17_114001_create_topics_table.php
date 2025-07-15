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
        if (! Schema::hasTable('topics')) {
            Schema::create('topics', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('order')->default(0);
                $table->unsignedBigInteger('documentation_id');
                $table->string('name', 255);
                $table->string('status', 60)->default('published');
                $table->timestamps();

                $table->foreign('documentation_id')->references('id')->on('documentations')->onDelete('cascade');
            });
        }

        if (! Schema::hasTable('topics_translations')) {
            Schema::create('topics_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->unsignedBigInteger('topic_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'topic_id'], 'topics_translations_primary');

                $table->foreign('topic_id')
                      ->references('id')
                      ->on('topics')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraints first
        // Schema::table('topics_translations', function (Blueprint $table) {
        //     $table->dropForeign(['topic_id']);
        // });
        // Schema::table('topics', function (Blueprint $table) {
        //     $table->dropForeign(['documentation_id']);
        // });

        // // Then drop the tables
        // Schema::dropIfExists('topics');
        // Schema::dropIfExists('topics_translations');
    }
};
