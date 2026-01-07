<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Zarif's Feature Routes (Chat, Uploads, Feeds)
    // Example: Route::get('/chat', \App\Livewire\Features\Chat::class);

    Route::get('/features/test', function () {
        return 'Features Route Works';
    });
});
