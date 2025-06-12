<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id',
        'customer_order_id',
        'customer_email_id',
        'order_date',
        'phone',
        'delivery_method_code',
        'delivery_name',
        'delivery_address1',
        'delivery_address2',
        'delivery_city',
        'delivery_state',
        'delivery_postal_code',
        'delivery_country',
        'address_type',
        'ship_node_type',
        'ship_node_name',
        'ship_node_id',
        'estimated_ship_date',
        'estimated_delivery_date',
    ];
}
