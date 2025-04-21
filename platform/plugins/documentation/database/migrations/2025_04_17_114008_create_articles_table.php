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
        if (! Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->string('title', 255);
                $table->text('content');
                $table->unsignedBigInteger('documentation_id');
                $table->unsignedBigInteger('topic_id');
                $table->unsignedBigInteger('user_id'); //created_by
                $table->string('status', 60)->default('published');
                $table->timestamps();

                $table->foreign('documentation_id')->references('id')->on('documentations')->onDelete('cascade');
                $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
        if (! Schema::hasTable('articles_translations')) {
            Schema::create('articles_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->unsignedBigInteger('article_id');
                $table->string('title', 255)->nullable();
                $table->text('content')->nullable();

                $table->primary(['lang_code', 'article_id'], 'articles_translations_primary');

                $table->foreign('article_id')
                    ->references('id')
                    ->on('articles')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('articles_translations');
    }
};
