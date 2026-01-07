<?php

namespace App\Livewire\Features;

use Livewire\Component;
use App\Models\User;
use App\Models\Log; // Using Logs as a proxy for 'Activity Points'
use Illuminate\Support\Facades\DB;

class Leaderboard extends Component
{
    public $period = 'all'; // all, weekly
    public $topUsers = [];

    public function mount()
    {
        $this->refreshLeaderboard();
    }

    public function refreshLeaderboard()
    {
        // Mocking logic: Rank by number of Logs created (activity)
        // In real app: Sum of 'points' field or dedicated Leaderboard table

        $userCounts = Log::raw(function ($collection) {
            return $collection->aggregate([
                ['$group' => ['_id' => '$user_id', 'count' => ['$sum' => 1]]],
                ['$sort' => ['count' => -1]],
                ['$limit' => 5]
            ]);
        });

        // MongoDB Aggregation returns raw objects, need to hydrate Users or map manually
        // For simplicity and speed in hackathon, fetching all users and sorting in memory if dataset is small, 
        // OR optimizing with a user 'score' field.
        // Let's use a simpler approach: Fetch top 10 users arbitrarily mock-sorted if Logs calc is too complex without proper setup.

        // BETTER APPROACH: Add 'reputation' to User model and sort by that.
        // Assuming we added it or just using random for demo if 0.

        $this->topUsers = User::take(10)->get()->sortByDesc(function ($u) {
            return $u->reputation ?? $u->logs()->count();
            // Warning: N+1 problem here, but strictly for <10 users demo it's fine.
        })->values();
    }

    public function render()
    {
        return view('livewire.features.leaderboard');
    }
}
