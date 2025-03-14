<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeAll extends Command
{
    protected $signature = 'serve:all';
    protected $description = 'Run Laravel, ngrok, and Vite (npm run dev) with one command';

    public function handle()
    {
        $this->info('🚀 Starting Laravel server...');
        $laravel = new Process(['php', 'artisan', 'serve']);
        $laravel->start();

        sleep(3); // Give Laravel time to start

        if ($this->isNgrokInstalled()) {
            $this->info('🌍 Starting ngrok...');
            $ngrok = new Process(['ngrok', 'http', '8000']);
            $ngrok->start();

            sleep(5); // Give ngrok time to initialize

            // Fetch ngrok URL dynamically
            $ngrokUrl = $this->getNgrokUrl();
            if ($ngrokUrl) {
                $this->info("🔗 ngrok Public URL: $ngrokUrl");
            } else {
                $this->error("⚠️ Could not retrieve ngrok URL. Is ngrok running?");
            }
        } else {
            $this->error("❌ ngrok is not installed! Skipping ngrok...");
            $this->warn("🔹 To install ngrok, visit: https://ngrok.com/download");
        }

        $this->info('🎨 Starting Vite (npm run dev)...');
        $vite = new Process(['npm', 'run', 'dev']);
        $vite->start();

        $this->info('✅ All services started! 🚀');

        while ($laravel->isRunning() || ($ngrok->isRunning() ?? false) || $vite->isRunning()) {
            sleep(1); // Keep checking if the processes are running
        }
    }

    private function isNgrokInstalled()
    {
        // Check if ngrok is installed by running "which" (Linux/Mac) or "where" (Windows)
        $process = new Process([PHP_OS_FAMILY === 'Windows' ? 'where' : 'which', 'ngrok']);
        $process->run();
        return $process->isSuccessful();
    }

    private function getNgrokUrl()
    {
        // Fetch ngrok public URL from its local API
        $json = @file_get_contents('http://127.0.0.1:4040/api/tunnels');
        if ($json === false) {
            return null;
        }

        $data = json_decode($json, true);
        return $data['tunnels'][0]['public_url'] ?? null;
    }
}
