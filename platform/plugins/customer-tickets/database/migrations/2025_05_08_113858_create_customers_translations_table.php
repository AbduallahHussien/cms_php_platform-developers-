<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // $this->down();
        if (! Schema::hasTable('customers_translations')) 
        {
            Schema::create('customers_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->unsignedBigInteger('customers_id');
                $table->string('name')->nullable();
                $table->text('notes')->nullable();

                $table->primary(['lang_code', 'customers_id'], 'customers_translations_primary');

                $table->foreign('customers_id')
                      ->references('id')
                      ->on('customers')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if (Schema::hasTable('customers_translations')) 
        {
            Schema::table('customers_translations', function (Blueprint $table) 
            {
                if (Schema::hasColumn('customers_translations', 'customers_id')) {
                    $table->dropForeign(['customers_id']);
                }
            });
            info('11111');
            Schema::dropIfExists('customers_translations');
            info('2222');
        }

          // Re-enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
