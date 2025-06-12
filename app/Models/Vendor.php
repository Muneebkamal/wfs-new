<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'vendor_alias',
        'address',
        'address1',
        'city',
        'state',
        'country',
        'zip_code',
        'phone',
        'contact_name',
        'contact_email',
        'other_method',
        'map',
        'paymet_term',
        'currecncy',
    ];

}
