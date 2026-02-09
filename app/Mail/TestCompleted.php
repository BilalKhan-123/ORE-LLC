<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class TestCompleted extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    private $result;

    public $pdfPath1;

    public $pdfPath2;

    public $pdfPath3;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $result, $pdfPath1, $pdfPath2, $pdfPath3)
    {
        $this->user = $user;
        $this->result = $result;
        $this->pdfPath1 = $pdfPath1;
        $this->pdfPath2 = $pdfPath2;
        $this->pdfPath3 = $pdfPath3;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = __('email.testCompleted.subject');

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
            markdown: 'emails.test-completed',
            with: ['user' => $this->user, 'result' => $this->result]
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath1)
                ->as('individual-factors.pdf')
                ->withMime('application/pdf'),

            Attachment::fromPath($this->pdfPath2)
                ->as('factors.pdf')
                ->withMime('application/pdf'),

            Attachment::fromPath($this->pdfPath3)
                ->as('factor-results.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
