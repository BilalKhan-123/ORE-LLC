<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class UserCouponAlert extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    private $promotionCode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $promotionCode)
    {
        $this->user = $user;
        $this->promotionCode = $promotionCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = __('email.userCouponAlert.subject');

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
            markdown: 'emails.user-coupon-alert',
            with: ['user' => $this->user, 'promotionCode' => $this->promotionCode]
        );
    }
}
