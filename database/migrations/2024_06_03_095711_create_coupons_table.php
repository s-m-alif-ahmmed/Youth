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
        if (!Schema::hasTable('coupons')) {
            Schema::create('coupons', function (Blueprint $table) {

                $table->id();
                //The discount coupon code
                $table->string('code')->unique();

                //The human readable discount code name
                $table->string('name')->nullable()->unique();

                //The max uses this discount coupon has
                $table->integer('max_uses')->nullable();

                //How many time a user can use this discount coupon
                $table->integer('max_uses_user')->nullable();

                //Whether or not the coupon is a percentage or a fixed price
                $table->enum('type',['percent', 'fixed'])->default('fixed');

                //The amount to discount based on type
                $table->integer('discount_amount')->nullable();

                //The minimum amount to discount based on type
                $table->double('min_amount',10,2)->nullable();

                //When the coupon begins
                $table->timestamp('starts_at')->nullable();

                //When the coupon ends
                $table->timestamp('expires_at')->nullable();

                $table->string('status')->default('active');

                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
