<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nid extends Model
{
    use HasFactory;
    protected $fillable = [
        'nid_number',
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'phone',
        'gender',
        'permanent_address',
        'current_address',

    ];

}
