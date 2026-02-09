<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class PaymentPaid extends Mailable
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
        $subject = __('email.cciPaymentPaid.subject');

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
            markdown: 'emails.payment-paid',
            with: ['user' => $this->user, 'payment' => $this->payment]
        );
    }
}
