<?php

namespace App\View\Components;

use App\Models\SeoSetting;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class SeoMeta extends Component
{
    public $title;
    public $description;
    public $image;

    public function __construct()
    {
        $route = Route::currentRouteName();
        $setting = SeoSetting::where('route_name', $route)->orWhere('route_name', '*')->orderBy('route_name', 'desc')->first();

        $this->title = $setting?->meta_title ?? config('app.name');
        $this->description = $setting?->meta_description ?? 'Welcome to ' . config('app.name');
        $this->image = $setting?->og_image ?? '';
    }

    public function render()
    {
        return view('components.seo-meta');
    }
}
