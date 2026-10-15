<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Một tin nhắn có thể có nhiều email trả lời
    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class, 'contact_id');
    }
}
