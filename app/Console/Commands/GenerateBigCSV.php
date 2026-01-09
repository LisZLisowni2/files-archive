<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateBigCSV extends Command
{
    protected $signature = 'make:csv {rows=100000}';
    protected $description = 'Generate a massive CSV file efficiently';

    public function handle()
    {
        $rows = (int) $this->argument('rows');
        $fileName = "exports/big_data.csv";
        
        // Ensure the directory exists
        Storage::makeDirectory('exports');
        
        // Use the absolute path for the PHP stream
        $path = storage_path("app/{$fileName}");
        $file = fopen($path, 'w');

        $this->info("Generating $rows rows...");
        $bar = $this->output->createProgressBar($rows);
        $bar->start();

        // Write Header
        fputcsv($file, ['id', 'name', 'email', 'created_at']);

        for ($i = 1; $i <= $rows; $i++) {
            fputcsv($file, [
                $i, 
                "User Name $i", 
                "user$i@example.com", 
                now()->toDateTimeString()
            ]);

            // Advance progress bar every 100 rows to reduce overhead
            if ($i % 100 === 0) {
                $bar->advance(100);
            }
        }

        fclose($file);
        $bar->finish();
        
        $this->newLine();
        $this->info("File saved at: $path");
    }
}