<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Mail\TestCompleted as TestCompletedMail;

class TestCompleted extends Notification
{
    use Queueable;

    private $user;

    private $resultData;

    private $pdfPath1;

    private $pdfPath2;

    private $pdfPath3;

    /**
     * Create a new notification instance.
     */
    //public function __construct($user, $resultData)
    public function __construct($user, $resultData, $pdfPath1, $pdfPath2, $pdfPath3)
    {
        $this->user = $user;
        $this->resultData = $resultData;
        $this->pdfPath1 = $pdfPath1;
        $this->pdfPath2 = $pdfPath2;
        $this->pdfPath3 = $pdfPath3;
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
        return (new TestCompletedMail($this->user, $this->resultData, $this->pdfPath1, $this->pdfPath2, $this->pdfPath3))->to($this->user->email);
        // return (new TestCompletedMail($this->user, $this->resultData,$this->pdfPath1,$this->pdfPath2,$this->pdfPath3))->to($sampleEmai);
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
