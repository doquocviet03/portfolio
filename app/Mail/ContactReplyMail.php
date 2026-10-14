<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $replySubject,
        public string $replyBody
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->replySubject
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-reply',
            with: [
                'replyBody' => $this->replyBody,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
