<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poperty_tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'divition',
        'municipality',
        'ward',
        'block',
        'subblock',
        'poperty_tax',
        'holding_number',
        'image',
        'year',
        'month',
        'active',
    ];

}
