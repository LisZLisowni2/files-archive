<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendRemainderEmail implements ShouldQueue
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
        SendWelcomeEmail::dispatch($this)->delay(now()->addHours(24));
    }
}
