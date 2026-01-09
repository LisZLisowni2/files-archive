<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    public $tries = 3;

    public $timeout = 120;

    public $failOnTimeout = true;

    public $backoff = [60, 120, 300];

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   
        sleep(10);
        // Fake mail
        Log::info("Job executed");
    }

    public function failed(\Throwable $exception): void {
        Log::error('Job failed', [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
        ]);
    }
}
