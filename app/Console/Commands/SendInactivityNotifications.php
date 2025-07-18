<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\InactivityService;

class SendInactivityNotifications extends Command
{
    protected $signature = 'inactivity:notify';
    protected $description = 'Send inactivity notifications to users';

    private $inactivityService;

    public function __construct(InactivityService $inactivityService)
    {
        parent::__construct();
        $this->inactivityService = $inactivityService;
    }

    public function handle()
    {
        $users = User::whereHas('inactivitySetting', function ($query) {
            $query->where('auto_release_enabled', true);
        })->get();

        foreach ($users as $user) {
            try {
                $this->inactivityService->checkUserInactivity($user);
            } catch (\Exception $e) {
                $this->error("Error checking user {$user->id}: " . $e->getMessage());
            }
        }

        $this->info('Inactivity notifications processed successfully.');
    }
}
