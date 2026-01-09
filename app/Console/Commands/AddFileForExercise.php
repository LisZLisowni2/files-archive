<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AddFileForExercise extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-file-for-exercise';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = "https://lekarzrodzinny.blog/wp-content/uploads/2020/07/erecepta-462x1024.png";
        $fileContents = file_get_contents($url);

        Storage::put("prescriptions/erecepta.png", $fileContents);
    }
}
