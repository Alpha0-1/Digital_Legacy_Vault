<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    protected static function bootAuditable()
    {
        foreach (self::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getModelEvents()
    {
        return ['created', 'updated', 'deleted'];
    }

    protected function recordActivity($event)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => "{$event}_" . strtolower(class_basename($this)),
            'description' => "A " . class_basename($this) . " was $event",
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent()
        ]);
    }
}
