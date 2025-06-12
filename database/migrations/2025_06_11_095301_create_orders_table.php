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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_id')->unique();
            $table->string('customer_order_id')->nullable();
            $table->string('customer_email_id')->nullable();
            $table->timestamp('order_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('delivery_method_code')->nullable();
            $table->string('delivery_name')->nullable();
            $table->string('delivery_address1')->nullable();
            $table->string('delivery_address2')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_state')->nullable();
            $table->string('delivery_postal_code')->nullable();
            $table->string('delivery_country')->nullable();
            $table->string('address_type')->nullable();
            $table->string('ship_node_type')->nullable();
            $table->string('ship_node_name')->nullable();
            $table->string('ship_node_id')->nullable();
            $table->string('estimated_ship_date')->nullable();
            $table->string('estimated_delivery_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
