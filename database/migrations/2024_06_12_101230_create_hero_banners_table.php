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
        if (!Schema::hasTable('hero_banners')) {
            Schema::create('hero_banners', function (Blueprint $table) {
                $table->id();
                $table->text('image')->nullable();
                $table->text('alt')->nullable();
                $table->string('status')->default('active');
                $table->string('first_status')->default('off');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
