<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
      \App\Console\Commands\FestCron::class,
      \App\Console\Commands\RefreshTokens::class,
    ];
	 
	 
    protected function schedule(Schedule $schedule)
    {
		
		$message = \App\Models\NewsletterMessage::orderBy('id', 'DESC')->first();
		$date = date('d', strtotime($message->date));
		$time = $message->time;
		$schedule->command('fest:cron')->monthlyOn($date, $time);
		
		$schedule->command('refresh:token')->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
