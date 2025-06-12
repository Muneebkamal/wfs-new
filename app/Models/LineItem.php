<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'line_number',
        'product_name',
        'sku',
        'condition',
        
        // Quantity
        'unit_of_measurement',
        'quantity',

        // Charges
        'charge_type',
        'charge_name',
        'charge_amount',
        'charge_currency',
        'tax_amount',

        // Fulfillment
        'fulfillment_option',
        'ship_method',
        'store_id',
        'pickup_datetime',
        'shipping_program_type',

        // Status & Refund
        'status_date',
        'order_line_statuses',
        'refund',
    ];

}
