<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    { 

        if (!Schema::hasTable('gifts')) 
        {
            Schema::create('gifts', function (Blueprint $table) 
            {
                $table->id();
                $table->string('project-name', 60);
                $table->string('email', 60);
                $table->string('donor-name', 60)->nullable();
                $table->string('donor-phone', 120)->nullable();
                $table->string('recipient-name', 120)->nullable();
                $table->string('recipient-phone', 120)->nullable();
                $table->string('template-name', 120)->nullable();
                $table->foreignId('cert_id')->nullable()->constrained('certs')->onDelete('cascade');
                $table->string('status', 60)->default('unread');
                $table->boolean('delivered')->default(false);
                $table->timestamps();
            });
        }

    }

    public function down(): void
    {
        Schema::dropIfExists('gifts');

    }
};
