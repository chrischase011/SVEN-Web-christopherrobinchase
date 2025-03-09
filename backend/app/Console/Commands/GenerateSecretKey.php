<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Str;
use File;

class GenerateSecretKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:secret-key {--local}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a secret key for frontend and save to .env';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keyName = $this->option('local') ? 'FRONTEND_SECRET_LOCAL' : 'FRONTEND_SECRET';
        $secretKey = Str::random(32);

        $this->updateEnvFile($keyName, $secretKey);

        $this->info("Secret key for {$keyName} generated successfully!");
    }

    private function updateEnvFile($key, $value)
    {
        $envPath = base_path('.env');

        if (!File::exists($envPath)) {
            $this->error('.env file not found!');
            return;
        }

        $envContent = File::get($envPath);
        $pattern = "/^{$key}=.*/m";

        if (preg_match($pattern, $envContent)) {
            $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
        } else {
            $envContent .= "\n{$key}={$value}";
        }

        File::put($envPath, $envContent);
    }
}
