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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('menu_id')->nullable();
                $table->foreignId('product_category_id')->nullable();
                $table->foreignId('product_sub_category_id')->nullable();
                $table->foreignId('product_brand_id')->nullable();
                $table->foreignId('offer_id')->nullable();
                $table->text('meta_title')->nullable();
                $table->longText('meta_description')->nullable();
                $table->text('name')->unique()->nullable();
                $table->text('image')->nullable();
                $table->string('alt')->nullable();
                $table->integer('stock')->nullable();
                $table->integer('regular_price')->nullable();
                $table->integer('selling_price')->nullable();
                $table->string('discount')->nullable();
                $table->longText('description')->nullable();
                $table->text('product_slug')->unique()->nullable();
                $table->string('status')->default('active');
                $table->string('popular_status')->default('inActive');
                $table->string('related_status')->default('inActive');
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
