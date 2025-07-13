<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\InactivityService;

class CheckInactiveUsers extends Command
{
    protected $signature = 'inactivity:check';
    protected $description = 'Check for inactive users and trigger legacy release if needed';

    protected $inactivityService;

    public function __construct(InactivityService $inactivityService)
    {
        parent::__construct();
        $this->inactivityService = $inactivityService;
    }

    public function handle()
    {
        $inactiveUsers = User::whereHas('inactivitySetting', function ($query) {
            $query->where('is_active', true);
        })->get();

        foreach ($inactiveUsers as $user) {
            try {
                if ($this->inactivityService->checkUserInactivity($user)) {
                    $this->info("User ID {$user->id} is inactive. Initiating legacy release.");
                    ProcessLegacyRelease::dispatch($user);
                }
            } catch (\Exception $e) {
                $this->error("Error checking user {$user->id}: " . $e->getMessage());
            }
        }

        $this->info('Inactivity check completed successfully.');
    }
}
