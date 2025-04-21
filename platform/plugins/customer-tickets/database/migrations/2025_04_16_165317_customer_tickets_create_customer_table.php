<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone_code');
                $table->string('phone');
                $table->string('email')->unique()->nullable();
                $table->string('nationality')->nullable();
                $table->enum('gender', ['male', 'female']);
                $table->enum('status', ['active', 'in_active'])->default('active');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }


    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
