<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SocialMedia\SocialMediaController;

class RefreshTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will refresh the token stored in the database on a regular interval';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$obj = new SocialMediaController;
		$obj->refreshPageToken();
		\Log::info("TOken updated!");
        return Command::SUCCESS;
    }
}
