<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\UserCouponAlert as UserCouponAlertMail;

class UserCouponAlert extends Notification
{
    use Queueable;

    private $user;

    private $promotionCodeData;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $promotionCodeData)
    {
        $this->user = $user;
        $this->promotionCodeData = $promotionCodeData;
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
        return (new UserCouponAlertMail($this->user, $this->promotionCodeData))->to($this->user->email);
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
