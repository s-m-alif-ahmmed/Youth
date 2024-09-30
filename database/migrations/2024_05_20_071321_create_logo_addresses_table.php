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
        if (!Schema::hasTable('logo_addresses')) {
            Schema::create('logo_addresses', function (Blueprint $table) {
                $table->id();
                $table->text('favicon')->nullable();
                $table->string('fav_alt')->nullable();
                $table->text('logo')->nullable();
                $table->text('footer_image')->nullable();
                $table->string('alt')->nullable();
                $table->string('footer_alt')->nullable();
                $table->text('address')->nullable();
                $table->string('gmail')->nullable();
                $table->string('number')->nullable();
                $table->text('slogan')->nullable();
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_addresses');
    }
};
