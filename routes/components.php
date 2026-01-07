<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Mizi's Component Routes (UI Demos, Styleguides)
    // Example: Route::get('/ui/buttons', function () { return view('ui.buttons'); });

    Route::get('/components/design', function () {
        return view('components.design.index');
    })->name('components.design');
});
