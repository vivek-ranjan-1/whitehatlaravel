<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsletterSubscriber;
use App\Notifications\FestNotification;

class FestCron extends Command 
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-newsletter';
	protected $signature = 'fest:cron';

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
        $subscribers = NewsletterSubscriber::all();
        foreach ($subscribers as $subscriber) {
            $subscriber->notify(new FestNotification());
        }
		\Log::info("Cron is working fine!");
    }
}
