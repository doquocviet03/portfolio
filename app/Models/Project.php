<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'description',
        'image',
        'technologies',
        'github_url',
        'demo_url',
        'features',
        'challenges',
        'results',
    ];
}
