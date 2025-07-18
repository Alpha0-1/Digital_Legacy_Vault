<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InactivityException extends Exception
{
    public function __construct(
        protected string $reason = 'User inactive for 90 days',
        protected int $threshold = 90
    ) {
        parent::__construct($this->reason);
    }

    public function render(Request $request)
    {
        return response()->json([
            'error' => 'Inactivity Detected',
            'reason' => $this->reason,
            'threshold' => $this->threshold,
            'release_scheduled' => now()->addDays($this->threshold - 90),
        ], Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
