<?php

namespace App\Services\Core;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogService extends BaseService
{
    /**
     * Create a log entry specifically attached to a causer and subject.
     */
    public function logModel(?Model $causer, ?Model $subject, string $description, array $properties = []): Log
    {
        return Log::create([
            'causer_id' => $causer ? $causer->getKey() : null,
            'causer_type' => $causer ? get_class($causer) : null,
            'subject_id' => $subject ? $subject->getKey() : null,
            'subject_type' => $subject ? get_class($subject) : null,
            'description' => $description,
            'properties' => $properties,
        ]);
    }

    /**
     * Create a log entry for the currently authenticated user.
     */
    public function log(string $description, array $properties = []): Log
    {
        $user = Auth::user();
        return $this->logModel($user, null, $description, $properties);
    }
}
