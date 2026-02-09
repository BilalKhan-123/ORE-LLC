<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\UserCouponAlert as NotificationUserCouponAlert;

class UserCouponAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $promotionCodeData;

    private $users;

    /**
     * Create a new job instance.
     */
    public function __construct($users, $promotionCodeData)
    {
        $this->promotionCodeData = $promotionCodeData;
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
                    $user->notify(new NotificationUserCouponAlert($user, $this->promotionCodeData));
                } catch (\Exception $e) {
                    Log::warning('User Coupon Alert Email Notification Error : ' . $e->getMessage());
                }
            }
        }
    }
}
