<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'level',
        'type',
        'description',
        'icon',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function scopeProgramming($query)
    {
        return $query->where('type', 'programming');
    }

    public function scopePersonal($query)
    {
        return $query->where('type', 'personal');
    }
}
