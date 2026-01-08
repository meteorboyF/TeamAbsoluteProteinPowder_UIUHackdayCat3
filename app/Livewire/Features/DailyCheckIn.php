<?php

namespace App\Livewire\Features;

use App\Models\Mood;
use App\Services\Features\GamificationService;
use Carbon\Carbon;
use Livewire\Component;

class DailyCheckIn extends Component
{
    public $hasCheckedInToday = false;
    public $currentStreak = 0;

    public function mount()
    {
        $this->checkTodayStatus();
        $this->calculateStreak();
    }

    public function checkIn(string $mood, GamificationService $gamification)
    {
        if ($this->hasCheckedInToday) {
            return;
        }

        // Record mood
        Mood::create([
            'user_id' => auth()->id(),
            'mood' => $mood,
            'date' => Carbon::today(),
        ]);

        // Award XP
        $gamification->awardXp(
            auth()->id(),
            'daily_check_in',
            50
        );

        // Update state
        $this->hasCheckedInToday = true;
        $this->calculateStreak();

        session()->flash('message', '✨ Check-in complete! +50 XP');
    }

    private function checkTodayStatus()
    {
        $this->hasCheckedInToday = Mood::where('user_id', auth()->id())
            ->whereDate('date', Carbon::today())
            ->exists();
    }

    private function calculateStreak()
    {
        $moods = Mood::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->toArray();

        $streak = 0;
        $currentDate = Carbon::today();

        foreach ($moods as $moodDate) {
            $moodDate = Carbon::parse($moodDate);

            if ($moodDate->isSameDay($currentDate)) {
                $streak++;
                $currentDate = $currentDate->subDay();
            } else {
                break;
            }
        }

        $this->currentStreak = $streak;
    }

    public function render()
    {
        return view('livewire.features.daily-check-in');
    }
}
