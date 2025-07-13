<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupExpiredSessions extends Command
{
    protected $signature = 'cleanup:expired-sessions';
    protected $description = 'Remove expired session records from the database';

    public function handle()
    {
        $this->info('Cleaning up expired sessions...');
        
        // Delete sessions older than 1 hour
        DB::table('sessions')
            ->where('last_activity', '<', now()->subHour()->timestamp)
            ->delete();
            
        $this->info('Expired sessions cleaned successfully.');
    }
}
