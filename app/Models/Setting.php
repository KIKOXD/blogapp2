<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle', 
        'hero_image',
        'about_title',
        'about_content',
        'contact_email',
        'contact_phone',
        'contact_address'
    ];
} 