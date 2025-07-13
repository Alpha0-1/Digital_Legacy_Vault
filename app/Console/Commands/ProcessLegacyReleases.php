<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LegacyReleaseService;
use App\Models\LegacyRelease;

class ProcessLegacyReleases extends Command
{
    protected $signature = 'legacy:process-releases';
    protected $description = 'Process pending legacy releases';

    private $legacyReleaseService;

    public function __construct(LegacyReleaseService $legacyReleaseService)
    {
        parent::__construct();
        $this->legacyReleaseService = $legacyReleaseService;
    }

    public function handle()
    {
        // Get pending releases
        $pendingReleases = LegacyRelease::where('status', 'pending')
            ->whereDate('release_date', '<=', now())
            ->get();

        foreach ($pendingReleases as $release) {
            try {
                $this->legacyReleaseService->processRelease($release);
                $this->info("Successfully processed release ID: {$release->id}");
            } catch (\Exception $e) {
                $this->error("Failed to process release ID: {$release->id}. Error: " . $e->getMessage());
            }
        }

        $this->info('Legacy release processing completed.');
    }
}
