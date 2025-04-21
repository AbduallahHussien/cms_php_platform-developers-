<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('tickets')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                $table->enum('type', ['inquiry', 'complaint', 'suggestion', 'other']);
                $table->enum('level', ['high', 'medium', 'low'])->nullable();
                $table->text('description')->nullable();
                $table->enum('status', ['open', 'in_progress', 'answered', 'pending', 'closed'])->default('open');
                $table->timestamps();
            });
        }


    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
