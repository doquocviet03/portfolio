<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactReply extends Model
{
    protected $table = 'contact_replies';

    protected $fillable = [
        'contact_id',
        'admin_id',
        'recipient_email',
        'subject',
        'body',
        'status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // Tin nhắn gốc được trả lời
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    // Tài khoản Admin gửi email
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Kiểm tra email đã gửi thành công
    public function isSent(): bool
    {
        return $this->status === 'sent';
    }

    // Kiểm tra email gửi thất bại
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
