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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('delivery_tax_id')->nullable();
                $table->foreignId('coupon_id')->nullable();
                $table->integer('discount_amount')->nullable();
                $table->integer('istimate_total')->nullable();
                $table->integer('order_total')->nullable();
                $table->string('name')->nullable();
                $table->text('address')->nullable();
                $table->string('city')->nullable();
                $table->integer('postal_code')->nullable();
                $table->string('number')->nullable();
                $table->string('status')->default('Pending');
                $table->string('note')->nullable();
                $table->string('all_terms')->nullable();
                $table->string('tracking_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
