<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_name',
        'user_id',
        'active',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',

    ];

}
