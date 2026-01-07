<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Mizi's Component Routes (UI Demos, Styleguides)
    // Example: Route::get('/ui/buttons', function () { return view('ui.buttons'); });

    Route::get('/components/test', function () {
        return 'Components Route Works';
    });
});
