<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'service_id',
        'tachnician_id',
        'tachnician_details',
        'officer_id',
        'officer_details',
        'solve_note',
        'equipment_details',
        'email',
        'phone',
        'problem_title',
        'problem_details',
        'room_number',
        'floor_number',
        'equipment_number',
        'feedback',
        'status',
        'officer_status',
        'officer_feedback',
        'technician_id',
        'technician_status',
        'technician_feedback',

    ];



}
