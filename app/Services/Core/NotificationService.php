<?php

namespace App\Services\Core;

use App\Models\Notification;
use App\Models\User;

class NotificationService extends BaseService
{
    /**
     * Send a notification to a user.
     */
    public function send(User $user, string $title, string $body, ?string $url = null, string $type = 'info'): Notification
    {
        return Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'body' => $body,
            'action_url' => $url,
            'type' => $type,
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification): void
    {
        $notification->update(['read_at' => now()]);
    }

    /**
     * Mark all user notifications as read.
     */
    public function markAllAsRead(User $user): void
    {
        Notification::where('user_id', $user->id)->whereNull('read_at')->update(['read_at' => now()]);
    }
}
