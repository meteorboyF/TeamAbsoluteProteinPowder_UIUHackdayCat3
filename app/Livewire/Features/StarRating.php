<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class StarRating extends Component
{
    public $model;
    public $rating = 0;
    public $comment = '';
    public $average = 0;
    public $count = 0;
    public $userReview = null;

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshStats();
    }

    public function refreshStats()
    {
        $reviews = Review::where('reviewable_id', $this->model->id)
            ->where('reviewable_type', get_class($this->model))
            ->get();

        $this->count = $reviews->count();
        $this->average = $this->count > 0 ? round($reviews->avg('rating'), 1) : 0;

        $userId = auth()->id() ?? 'anon_user';
        $this->userReview = $reviews->where('user_id', $userId)->first();

        if ($this->userReview) {
            $this->rating = $this->userReview->rating;
            $this->comment = $this->userReview->comment;
        }
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $userId = auth()->id() ?? 'anon_user'; // For hackathon

        Review::updateOrCreate(
            [
                'user_id' => $userId,
                'reviewable_id' => $this->model->id,
                'reviewable_type' => get_class($this->model),
            ],
            [
                'rating' => $this->rating,
                'comment' => $this->comment
            ]
        );

        $this->refreshStats();
    }

    public function setRating($val)
    {
        $this->rating = $val;
    }

    public function render()
    {
        return view('livewire.features.star-rating');
    }
}
