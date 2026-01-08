<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles', // Added for RBAC
        'banned_at', // Feature 17: User Banning
        'partner_id', // Project US: Couples linking
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'banned_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles ?? []);
    }

    /**
     * Get the user's partner (Project US)
     */
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    /**
     * Get the user's current active status (Project US)
     */
    public function currentStatus()
    {
        return $this->hasOne(Status::class)->where('is_active', true)->latest();
    }

    /**
     * Get user's total XP (Project US)
     */
    public function totalXp(): int
    {
        return $this->hasMany(XpLog::class)->sum('xp_amount');
    }

    /**
     * Get user's current level (Project US)
     */
    public function level(): int
    {
        $gamification = app(\App\Services\Features\GamificationService::class);
        return $gamification->getUserLevel($this->id);
    }
}
