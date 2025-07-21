<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre demande de stand a été approuvée - Eat&Drink',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.approval-notification',
            with: [
                'user' => $this->user,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
} 