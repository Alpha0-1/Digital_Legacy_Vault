<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }

    protected function schedule(Schedule $schedule)
    {
        // Daily inactivity check
        $schedule->command('vault:check-inactivity')
            ->daily()
            ->runInBackground()
            ->emailOutputTo('devops@digitallegacy.io');

        // Process legacy releases
        $schedule->command('vault:process-releases')
            ->dailyAt('03:00')
            ->runInBackground()
            ->emailOutputOnFailure('devops@digitallegacy.io');

        // Cleanup expired sessions
        $schedule->command('vault:cleanup-sessions')
            ->hourly()
            ->withoutOverlapping();
    }
}
