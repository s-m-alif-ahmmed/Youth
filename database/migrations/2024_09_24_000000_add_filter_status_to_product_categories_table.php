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
        if (Schema::hasTable('product_categories') && !Schema::hasColumn('product_categories', 'filter_status')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->string('filter_status')->default('inActive')->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('product_categories') && Schema::hasColumn('product_categories', 'filter_status')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->dropColumn('filter_status');
            });
        }
    }
};
