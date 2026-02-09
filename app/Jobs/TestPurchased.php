<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\TestPurchased as NotificationTestPurchased;

class TestPurchased implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $paymentData;

    private $users;

    /**
     * Create a new job instance.
     */
    public function __construct($users, $paymentData)
    {
        $this->paymentData = $paymentData;
        $this->users = $users;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! empty($this->users)) {
            foreach ($this->users as $user) {
                try {
                    $user->notify(new NotificationTestPurchased($user, $this->paymentData));
                } catch (\Exception $e) {
                    Log::warning('Client Test Purchase Email Notification Error : ' . $e->getMessage());
                }
            }
        }
    }
}
