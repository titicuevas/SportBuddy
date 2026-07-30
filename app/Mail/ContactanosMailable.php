<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactanosMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [$this->user->email],
            subject: 'Contacto desde SportBuddy — '.$this->user->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contactanos',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
