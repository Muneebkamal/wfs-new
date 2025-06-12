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
        Schema::create('line_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            // Basic line item info
            $table->string('line_number');
            $table->string('product_name');
            $table->string('sku');
            $table->string('condition')->nullable();

            // Quantity
            $table->string('unit_of_measurement')->nullable();
            $table->integer('quantity')->default(1);

            // Charges
            $table->string('charge_type')->nullable(); // PRODUCT, SHIPPING, etc.
            $table->string('charge_name')->nullable(); // ItemPrice, etc.
            $table->double('charge_amount', 10, 2)->nullable(); // 14.99
            $table->string('charge_currency')->nullable(); // USD
            $table->double('tax_amount', 10, 2)->nullable(); // if tax is ever populated

            // Fulfillment
            $table->string('fulfillment_option')->nullable();
            $table->string('ship_method')->nullable();
            $table->string('store_id')->nullable();
            $table->string('pickup_datetime')->nullable();
            $table->string('shipping_program_type')->nullable();

            // Status & Refund
            $table->string('status_date')->nullable();
            $table->text('order_line_statuses')->nullable(); // store JSON
            $table->text('refund')->nullable(); // if refund populated, store as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_items');
    }
};
