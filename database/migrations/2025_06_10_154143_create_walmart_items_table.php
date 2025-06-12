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
        Schema::create('walmart_items', function (Blueprint $table) {
            $table->id();
            $table->string('mart')->nullable();
            $table->string('sku')->unique();
            $table->string('availability')->nullable();
            $table->string('wpid')->nullable();
            $table->string('upc')->nullable();
            $table->string('gtin')->nullable();
            $table->string('product_name')->nullable();
            $table->text('shelf')->nullable();
            $table->string('product_type')->nullable();
            $table->string('currency', 10)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('published_status')->nullable();
            $table->string('lifecycle_status')->nullable();
            $table->boolean('is_duplicate')->default(false);
            $table->string('variant_group_id')->nullable();
            $table->text('variant_group_info')->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walmart_items');
    }
};
