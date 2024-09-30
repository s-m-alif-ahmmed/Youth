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
        if (!Schema::hasTable('product_sub_categories')) {
            Schema::create('product_sub_categories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id')->nullable();
                $table->foreignId('product_category_id')->nullable();
                $table->string('name')->unique();
                $table->text('image')->nullable();
                $table->string('alt')->nullable();
                $table->text('product_sub_category_slug')->nullable();
                $table->string('status')->default('active');
                $table->string('filter_status')->default('inActive');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sub_categories');
    }
};
