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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            // display name
            $table->string('name');
            // product_id
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // price
            $table->float('price', 10);
            $table->float('compare_price', 10)->default(0);
            // sku
            $table->string('sku');
            $table->unique(['product_id', 'name']);
            $table->unique('sku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
