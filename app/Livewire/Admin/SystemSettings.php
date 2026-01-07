<?php

namespace App\Livewire\Admin;

use App\Models\Feature;
use App\Services\Core\SettingService;
use Livewire\Component;

class SystemSettings extends Component
{
    // General Settings
    public $siteName;
    public $supportEmail;
    public $primaryColor;

    // Feature Flags
    public $features;

    public function mount()
    {
        $settings = new SettingService();
        $this->siteName = $settings->get('site_name', config('app.name'));
        $this->supportEmail = $settings->get('support_email', 'help@example.com');
        $this->primaryColor = $settings->get('primary_color', '#4F46E5');

        $this->refreshFeatures();
    }

    public function refreshFeatures()
    {
        $this->features = Feature::all();
    }

    public function saveSettings()
    {
        $settings = new SettingService();
        $settings->set('site_name', $this->siteName);
        $settings->set('support_email', $this->supportEmail);
        $settings->set('primary_color', $this->primaryColor);

        session()->flash('message', 'System settings saved.');
    }

    public function toggleFeature($id)
    {
        $feature = Feature::find($id);
        if ($feature) {
            $feature->is_active = !$feature->is_active;
            $feature->save();
        }
        $this->refreshFeatures();
    }

    public function createFeature()
    {
        // Simple stub to create default features if none exist
        if ($this->features->isEmpty()) {
            Feature::create(['name' => 'User Chat', 'key' => 'chat', 'is_active' => true]);
            Feature::create(['name' => 'Forums', 'key' => 'forums', 'is_active' => true]);
            Feature::create(['name' => 'Marketplace', 'key' => 'marketplace', 'is_active' => false]);
            $this->refreshFeatures();
        }
    }

    public function render()
    {
        return view('livewire.admin.system-settings')->layout('layouts.app');
    }
}
