<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['web'])->group(function () {
    // Admin routes will go here
    Route::get('/logs', \App\Livewire\Admin\LogViewer::class)->name('admin.logs');
    Route::get('/test', function () {
        return 'Admin Route Works!';
    });
});
