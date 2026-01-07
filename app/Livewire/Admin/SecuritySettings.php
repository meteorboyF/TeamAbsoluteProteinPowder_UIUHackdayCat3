<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\Core\SettingService;
use Livewire\Component;
use Livewire\WithPagination;

class SecuritySettings extends Component
{
    use WithPagination;

    public $maintenanceMode = false;
    public $searchUser = '';

    public function mount()
    {
        $this->maintenanceMode = (new SettingService())->get('maintenance_mode', false);
    }

    public function toggleMaintenance()
    {
        $this->maintenanceMode = !$this->maintenanceMode;
        (new SettingService())->set('maintenance_mode', $this->maintenanceMode);

        // In a real app, this would also run Artisan::call('down'), 
        // but since we have environment issues, we trust the DB setting + Middleware.
    }

    public function toggleBan($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->banned_at = $user->banned_at ? null : now();
            $user->save();
        }
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->searchUser . '%')
            ->orWhere('email', 'like', '%' . $this->searchUser . '%')
            ->paginate(10);

        return view('livewire.admin.security-settings', [
            'users' => $users
        ])->layout('layouts.app');
    }
}
