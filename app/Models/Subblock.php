<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subblock extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_id',
        'subblock_name',
    ];
}
