<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    { 
        if (!Schema::hasTable('certs')) 
        {
            Schema::create('certs', function (Blueprint $table) 
            {
                $table->id();
                $table->string('name');
                $table->string('font_size');
                $table->string('font_color');
                $table->string('status', 60)->default('published');
                $table->string('image')->nullable();
                $table->integer('from_x'); // X-coordinate start
                $table->integer('from_y'); // Y-coordinate start
                $table->integer('to_x');   // X-coordinate end
                $table->integer('to_y');   // Y-coordinate end
                $table->timestamps();
            });
        }

    }

    public function down(): void
    {
        Schema::dropIfExists('certs');

    }
};
