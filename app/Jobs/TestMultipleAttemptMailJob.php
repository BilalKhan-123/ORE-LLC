<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\TestMultiAttempt as TestMultiAttemptMail;

class TestMultipleAttemptMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $toUser;

    /**
     * Create a new job instance.
     */
    public function __construct(object $toUser)
    {
        $this->toUser = $toUser;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Test Work');
        try {
            Mail::send(new TestMultiAttemptMail($this->toUser));
        } catch (\Exception $e) {
            Log::info('Multiple attempt Email Failed : ' . $e->getMessage());
        }
    }
}
