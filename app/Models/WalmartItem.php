<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalmartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'mart',
        'sku',
        'availability',
        'wpid',
        'upc',
        'gtin',
        'product_name',
        'shelf',
        'product_type',
        'currency',
        'price',
        'published_status',
        'lifecycle_status',
        'is_duplicate',
        'variant_group_id',
        'variant_group_info',
        'image',
        'images'
    ];
}
