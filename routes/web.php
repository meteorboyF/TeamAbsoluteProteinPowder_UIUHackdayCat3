<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // -- PROJECT US ROUTES --
    // The Vault (Sharing a Secret)
    Route::get('/vault', function () {
        return view('livewire.features.vault'); // Mizi will build this
    })->name('vault');

    // The Space (New Language)
    Route::get('/space', function () {
        return view('livewire.features.space'); // Fardeen will build this backend
    })->name('space');

    // Resonance (Heart Not Mouth)
    Route::get('/conflict', function () {
        return view('livewire.features.conflict-chat'); // Zarif will build this
    })->name('conflict');

    Route::get('/profile', \App\Livewire\Core\Profile::class)->name('profile');

    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
