<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seting extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name',
        'short_desc',
        'address',
        'email',
        'phone',
        'footer',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'skype_link',
        'instagram_link'

    ];



}
