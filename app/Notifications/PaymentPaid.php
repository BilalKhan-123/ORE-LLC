<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\PaymentPaid as PaymentPaidMail;

class PaymentPaid extends Notification
{
    use Queueable;

    private $user;

    private $paymentData;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $paymentData)
    {
        $this->user = $user;
        $this->paymentData = $paymentData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        return (new PaymentPaidMail($this->user, $this->paymentData))->to($this->user->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
