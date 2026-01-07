<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    // Zarif's Feature Routes (Chat, Uploads, Feeds)
    // Example: Route::get('/chat', \App\Livewire\Features\Chat::class);

    Route::get('/features/test', function () {
        return 'Features Route Works';
    });

    // 1. Recursive Comments Test
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
    });

    // 2. Generic Chat Test
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

    // 3. Group Channels Test
    Route::get('/features/test-group-chat', function () {
        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Group Chat</title>
            <script src="https://cdn.tailwindcss.com"></script>
            @livewireStyles
        </head>
        <body>
            @livewire('features.group-chat')
            @livewireScripts
        </body>
        </html>
        HTML;
    });

    // 4. Feed & Notifications Test
    Route::get('/features/test-feed', function () {
        // Create dummy logs if none exist
        if (\App\Models\Log::count() == 0) {
            \App\Models\Log::create([
                'user_id' => 1,
                'type' => 'system',
                'description' => 'System initialized',
                'subject_id' => 1,
                'subject_type' => 'App\Models\User'
            ]);
            \App\Models\Log::create([
                'user_id' => 2,
                'type' => 'comment',
                'description' => 'User 2 posted a comment',
                'subject_id' => 1,
                'subject_type' => 'App\Models\User'
            ]);
        }

        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Feed & Notifications</title>
            <script src="https://cdn.tailwindcss.com"></script>
            @livewireStyles
        </head>
        <body class="bg-gray-50 p-10">
            <!-- Navbar Mockup -->
            <div class="flex justify-between items-center bg-white p-4 shadow mb-10 rounded">
                <h1 class="font-bold">App Header</h1>
                @livewire('features.notifications')
            </div>

            <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
                <!-- Feed -->
                @livewire('features.activity-feed')
            </div>

            @livewireScripts
        </body>
        </html>
        HTML;
    });

    // 5. Interaction Test (Likes & Reviews)
    Route::get('/features/test-interaction', function () {
        $item = \App\Models\User::first(); // Attaching to a user for demo (e.g. "Rate this Seller")

        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Likes & Reviews</title>
            <script src="https://cdn.tailwindcss.com"></script>
            @livewireStyles
        </head>
        <body class="bg-gray-100 p-10 flex gap-10 justify-center items-start">
            
            <!-- Card 1: Like Button -->
            <div class="bg-white p-6 rounded shadow w-64">
                <h2 class="font-bold mb-4">Like Button</h2>
                <div class="flex items-center justify-between">
                    <span>Profile: {$item->name}</span>
                    @livewire('features.like-button', ['model' => \$item])
                </div>
            </div>

            <!-- Card 2: Reviews -->
            <div class="bg-white p-6 rounded shadow w-96">
                <h2 class="font-bold mb-4">Reviews & Ratings</h2>
                <p class="text-sm text-gray-500 mb-4">Rate this user:</p>
                @livewire('features.star-rating', ['model' => \$item])
            </div>
            
            <!-- Card 3: New Engagement Features -->
            <div class="bg-white p-6 rounded shadow w-80 space-y-6">
                <h2 class="font-bold border-b pb-2">Engagement</h2>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">User Relationship</span>
                    @livewire('features.follow-button', ['targetUserId' => \$item->id])
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Save Profile</span>
                    @livewire('features.bookmark-button', ['model' => \$item])
                </div>

                <div>
                    <p class="text-xs text-gray-400 mb-2 uppercase font-bold">Share Profile</p>
                    @livewire('features.social-share', ['url' => request()->fullUrl(), 'title' => 'Check out this profile!'])
                </div>
            </div>

            @livewireScripts
        </body>
        </html>
        HTML;
    });

    // 6. Content Tools Test (Search & Upload)
    Route::get('/features/test-content', function () {
        $user = \App\Models\User::first() ?? \App\Models\User::create(['name' => 'Demo User', 'email' => 'demo@example.com']);

        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Content Tools</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
            @livewireStyles
        </head>
        <body class="bg-gray-100 p-10">
            <!-- Global Search (Hidden by default, press Ctrl+K) -->
            @livewire('features.global-search')
            
            <div class="max-w-4xl mx-auto space-y-10">
                <div class="bg-blue-600 text-white p-6 rounded-lg shadow-lg">
                    <h1 class="text-2xl font-bold mb-2">Content Efficiency Tools</h1>
                    <p>Press <span class="bg-white/20 px-2 py-0.5 rounded font-mono text-sm">Cmd+K</span> or <span class="bg-white/20 px-2 py-0.5 rounded font-mono text-sm">Ctrl+K</span> to open Global Search.</p>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <!-- Card: File Uploader -->
                    <div class="bg-white p-6 rounded shadow">
                        <h2 class="font-bold mb-4">Generic File Uploader</h2>
                        <p class="text-xs text-gray-500 mb-4">Attaching files to User #{$user->id}</p>
                        @livewire('features.file-uploader', ['model' => \$user])
                    </div>

                    <!-- Right Column: Tags, Polls, Report -->
                    <div class="space-y-8">
                        <!-- Card: Tags -->
                        <div class="bg-white p-6 rounded shadow">
                            <h2 class="font-bold mb-4">Smart Tags</h2>
                            <p class="text-xs text-gray-500 mb-2">Tagging User: {$user->name}</p>
                            @livewire('features.tag-input', ['model' => \$user])
                        </div>

                        <!-- Card: Polls -->
                        <div class="bg-white p-6 rounded shadow relative">
                            <h2 class="font-bold mb-4">Community Poll</h2>
                            @livewire('features.poll-widget', ['model' => \$user])
                            
                            <div class="absolute top-6 right-6">
                                @livewire('features.report-modal', ['model' => \$user])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @livewireScripts
        </body>
        </html>
        HTML;
    });

    // 7. Utility & Commerce Test
    Route::get('/features/test-utility', function () {
        $user = \App\Models\User::first() ?? \App\Models\User::create(['name' => 'Gamer User', 'email' => 'game@example.com']);

        // Seed some data if empty
        if (\App\Models\InventoryItem::count() == 0) {
            \App\Models\InventoryItem::create(['user_id' => $user->id, 'name' => 'Health Potion', 'type' => 'consumable', 'quantity' => 5, 'icon' => '🧪']);
            \App\Models\InventoryItem::create(['user_id' => $user->id, 'name' => 'Gold Coin', 'type' => 'currency', 'quantity' => 100, 'icon' => '🪙']);
        }

        if (\App\Models\Event::count() == 0) {
            \App\Models\Event::create(['title' => 'Hackathon Deadline', 'start_at' => now()->addDays(1), 'location' => 'Online', 'user_id' => 1]);
        }

        if (\App\Models\Announcement::count() == 0) {
            \App\Models\Announcement::create(['message' => 'Welcome to the Universal SaaS Demo! 🚀', 'type' => 'info', 'is_active' => true]);
        }

        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <title>Test Utilities</title>
            <script src="https://cdn.tailwindcss.com"></script>
            @livewireStyles
        </head>
        <body class="bg-gray-100">
            @livewire('features.announcement-banner')

            <div class="p-10 max-w-6xl mx-auto space-y-10">
                <h1 class="text-3xl font-bold text-gray-800">Utility & Commerce Module</h1>

                <div class="grid grid-cols-2 gap-8">
                    <!-- Inventory -->
                    <div>
                        <h2 class="font-bold mb-4 text-xl">1. User Inventory</h2>
                        @livewire('features.user-inventory', ['userId' => \$user->id])
                    </div>
                    
                    <!-- Leaderboard -->
                    <div>
                        <h2 class="font-bold mb-4 text-xl">2. Leaderboard</h2>
                        @livewire('features.leaderboard')
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-8">
                    <!-- Events -->
                    <div class="col-span-1">
                        <h2 class="font-bold mb-4 text-xl">3. Upcoming Events</h2>
                        @livewire('features.event-list')
                    </div>
                    
                    <!-- Kanban -->
                    <div class="col-span-2">
                        <h2 class="font-bold mb-4 text-xl">4. Task Board (Kanban)</h2>
                        <p class="text-xs text-gray-500 mb-2">Project: Protocol Zero</p>
                        @livewire('features.kanban-board', ['model' => \$user])
                    </div>
                </div>
            </div>

            @livewireScripts
        </body>
        </html>
        HTML;
    });
});
