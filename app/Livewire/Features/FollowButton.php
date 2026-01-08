<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\User;
use App\Models\Follow;

class FollowButton extends Component
{
    public $targetUserId;
    public $isFollowing = false;
    public $count = 0;

    public function mount($targetUserId)
    {
        $this->targetUserId = $targetUserId;
        $this->refreshState();
    }

    public function refreshState()
    {
        $this->count = Follow::where('followed_id', $this->targetUserId)->count();

        $myId = auth()->id();
        if ($myId) {
            $this->isFollowing = Follow::where('follower_id', $myId)
                ->where('followed_id', $this->targetUserId)
                ->exists();
        }
    }

    public function toggleFollow()
    {
        $myId = auth()->id() ?? 'anon_user';
        if ($myId == $this->targetUserId)
            return; // Can't follow self

        if ($this->isFollowing) {
            Follow::where('follower_id', $myId)
                ->where('followed_id', $this->targetUserId)
                ->delete();
        } else {
            Follow::create([
                'follower_id' => $myId,
                'followed_id' => $this->targetUserId,
            ]);
        }

        $this->refreshState();
    }

    public function render()
    {
        return view('livewire.features.follow-button');
    }
}
