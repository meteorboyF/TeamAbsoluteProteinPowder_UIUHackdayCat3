<?php

namespace App\Livewire\Core;

use App\Models\Notification;
use App\Services\Core\NotificationService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $unreadCount = 0;

    public function getListeners()
    {
        return [
            'echo-private:App.Models.User.' . Auth::id() . ',NotificationCreated' => 'refresh',
            'refreshNotifications' => '$refresh',
        ];
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && $notification->user_id === Auth::id()) {
            (new NotificationService())->markAsRead($notification);
        }
    }

    public function markAllRead()
    {
        if (Auth::check()) {
            (new NotificationService())->markAllAsRead(Auth::user());
        }
    }

    public function render()
    {
        $user = Auth::user();
        if (!$user) {
            return view('livewire.core.notifications', ['notifications' => []]);
        }

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $this->unreadCount = Notification::where('user_id', $user->id)->unread()->count();

        return view('livewire.core.notifications', [
            'notifications' => $notifications,
        ]);
    }
}
