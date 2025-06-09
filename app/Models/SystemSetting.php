<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value',
        'created_by',
        'updated_by',
    ];
    public $timestamps = true; // Only if your table has created_at and updated_at

}
