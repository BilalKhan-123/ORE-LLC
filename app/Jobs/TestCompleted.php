<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\TestCompleted as NotificationTestCompleted;

class TestCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $resultData;

    private $users;

    private $pdfPath1;

    private $pdfPath2;

    private $pdfPath3;

    /**
     * Create a new job instance.
     */
    //public function __construct($users, $resultData)
    public function __construct($users, $resultData, $pdfPath1, $pdfPath2, $pdfPath3)
    {
        $this->resultData = $resultData;
        $this->users = $users;
        $this->pdfPath1 = $pdfPath1;
        $this->pdfPath2 = $pdfPath2;
        $this->pdfPath3 = $pdfPath3;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! empty($this->users)) {
            foreach ($this->users as $user) {
                try {
                    $user->notify(new NotificationTestCompleted($user, $this->resultData, $this->pdfPath1, $this->pdfPath2, $this->pdfPath3));
                } catch (\Exception $e) {
                    Log::warning('Test Completed Email Notification Error : ' . $e->getMessage());
                }
            }
        }
    }
}
