<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class TestPurchased extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    private $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = '';
        if ($this->user->hasRole(config('site.roles.client'))) {
            $subject = __('email.testPurchased.subject', ['productName' => $this->payment['productName']]);
        } else {
            $subject = __('email.participantTestPurchased.subject', ['productName' => $this->payment['productName']]);
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.test-purchased',
            with: ['user' => $this->user, 'payment' => $this->payment]
        );
    }
}
