<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_category_blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('blog_id');
            $table->integer('blog_category_id');
            $table->unique(['blog_id', 'blog_category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_category_blogs');
    }
};
