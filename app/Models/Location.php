<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'company',
        'emails',
        'phone',
        'mobile',
        'fax',
        'website',
        'street',
        'city',
        'state',
        'zip',
        'country',
        'created_by',
        'updated_by'
    ];

}
