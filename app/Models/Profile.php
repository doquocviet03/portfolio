<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'full_name',
        'job_title',
        'field',
        'location',
        'short_bio',
        'about_me',
        'career_goal',
        'avatar',
        'contact_email',
        'phone',
        'github_url',
        'facebook_url',
        'linkedin_url',
        'cv_path',
    ];
}
