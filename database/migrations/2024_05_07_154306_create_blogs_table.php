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
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id');
                $table->text('meta_title');
                $table->text('meta_description');
                $table->text('image');
                $table->string('alt');
                $table->text('title')->unique();
                $table->text('short_description');
                $table->longText('description');
                $table->text('slug');
                $table->string('status')->default('Publish');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
