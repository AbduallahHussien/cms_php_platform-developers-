<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
                $table->text('text');
                $table->timestamps();
            });
        }


    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
