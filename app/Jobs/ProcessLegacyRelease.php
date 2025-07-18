<?php

namespace App\Jobs;

use App\Models\LegacyRelease;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessLegacyRelease implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $release;

    public function __construct(LegacyRelease $release)
    {
        $this->release = $release;
    }

    public function handle()
    {
        try {
            $this->release->status = 'processing';
            $this->release->save();

            $vault = $this->release->vault;
            $vault->releaseToBeneficiaries($this->release->beneficiary_id);

            $this->release->status = 'released';
            $this->release->save();

            \App\Mail\LegacyReleaseNotification::dispatch($this->release);
        } catch (\Exception $e) {
            $this->release->status = 'failed';
            $this->release->reason = $e->getMessage();
            $this->release->save();
        }
    }
}
