<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

Route::middleware(['web', 'auth', 'role:admin'])->prefix('admin')->group(function () {

    // Feature 15: System Health
    Route::get('/health', function () {
        $mongoStatus = 'Unknown';
        try {
            DB::connection('mongodb')->getMongoClient()->listDatabases();
            $mongoStatus = 'Connected';
        } catch (\Exception $e) {
            $mongoStatus = 'Error: ' . $e->getMessage();
        }

        $cacheStatus = Cache::store()->get('health_check') ? 'Working' : 'Unknown';
        if ($cacheStatus === 'Unknown') {
            Cache::put('health_check', 'ok', 10);
            $cacheStatus = 'Write OK';
        }

        return view('admin.health', compact('mongoStatus', 'cacheStatus'));
    })->name('admin.health');

    // Feature 13: Impersonation
    Route::get('/impersonate/{id}', function ($id) {
        if (session()->has('impersonator_id')) {
            return redirect()->back()->with('error', 'Already impersonating');
        }

        $user = \App\Models\User::find($id);
        if ($user) {
            session()->put('impersonator_id', auth()->id());
            auth()->login($user);
            return redirect('/dashboard');
        }
        return redirect()->back();
    })->name('admin.impersonate');

    // Stop Impersonation
    Route::get('/impersonate/stop', function () {
        if (session()->has('impersonator_id')) {
            auth()->loginUsingId(session()->pull('impersonator_id'));
            return redirect('/admin/dashboard');
        }
        return redirect('/dashboard');
    })->name('impersonate.stop');
});
