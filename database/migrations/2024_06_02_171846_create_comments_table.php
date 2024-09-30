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
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('blog_id')->nullable();
                $table->foreignId('parent_id')->nullable();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->longtext('comment')->nullable();
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
        Schema::dropIfExists('comments');
    }
};
