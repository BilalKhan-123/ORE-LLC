<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class TestMultiAttempt extends Mailable
{
    use Queueable, SerializesModels;

    private object $toUser;

    /**
     * Create a new message instance.
     */
    public function __construct(object $toUser)
    {
        $this->toUser = $toUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('email.multiAttempt.subject', [
                'appName' => config('app.name'),
            ], $this->toUser->language),
            to: [$this->toUser->email],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.multiple-attempt',
            with: [
                'user' => $this->toUser,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
