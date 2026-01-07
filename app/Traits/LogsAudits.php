<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsAudits
{
    public static function bootLogsAudits()
    {
        static::created(function ($model) {
            self::logAudit($model, 'created', [], $model->getAttributes());
        });

        static::updated(function ($model) {
            // Get changed attributes
            $changes = $model->getChanges();
            $original = $model->getOriginal();

            // Filter original to only keys present in changes
            $old = array_intersect_key($original, $changes);

            self::logAudit($model, 'updated', $old, $changes);
        });

        static::deleted(function ($model) {
            self::logAudit($model, 'deleted', $model->getAttributes(), []);
        });
    }

    protected static function logAudit($model, $event, $old, $new)
    {
        if (empty($old) && empty($new) && $event === 'updated') {
            return;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => $event,
            'old_values' => $old,
            'new_values' => $new,
            'url' => Request::fullUrl(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
