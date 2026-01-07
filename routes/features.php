<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Zarif's Feature Routes (Chat, Uploads, Feeds)
    // Example: Route::get('/chat', \App\Livewire\Features\Chat::class);

    Route::get('/features/test', function () {
        return 'Features Route Works';
    });

    Route::get('/features/test-comments', function () {
        $user = \App\Models\User::first() ?? \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Comments</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="bg-gray-100 p-10">
            <h1 class="text-2xl font-bold mb-5">Testing Generic Comments</h1>
            <p class="mb-5">Attaching comments to User: {$user->name} (ID: {$user->id})</p>
            @livewire('features.comments', ['model' => \$user])
        </body>
        </html>
        HTML;
        Route::get('/features/test-chat', function () {
            $project = \App\Models\User::first(); // attaching to user as a "DM" concept for now

            return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Chat</title>
            <script src="https://cdn.tailwindcss.com"></script>
            @livewireStyles
        </head>
        <body class="bg-gray-200 p-10 h-screen">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-2xl font-bold mb-5">Testing Generic Chat (DM Mode)</h1>
                <p class="mb-5">Chatting with context: {$project->name}</p>
                @livewire('features.chat', ['model' => \$project])
            </div>
            @livewireScripts
        </body>
        </html>
        HTML;
        });
    });
});
