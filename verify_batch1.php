<?php

use App\Models\User;
use App\Models\Notification;
use App\Services\Core\NotificationService;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "--- Batch 1 Verification ---\n";

    // 1. Create User
    echo "1. Creating User...\n";
    $user = User::create([
        'name' => 'Batch 1 Tester',
        'email' => 'batch1@test.com',
        'password' => Hash::make('secret'),
    ]);
    echo "User ID: " . $user->id . "\n";

    // 2. Test Notification Service
    echo "2. Sending Notification...\n";
    $service = new NotificationService();
    $note = $service->send($user, 'Welcome', 'Welcome to the system!', '/dashboard');

    if (Notification::count() > 0) {
        echo "PASS: Notification created.\n";
    } else {
        echo "FAIL: No notification found.\n";
    }

    // 3. Mark Read
    echo "3. Marking Read...\n";
    $service->markAsRead($note);
    if ($note->fresh()->read_at) {
        echo "PASS: Notification marked read.\n";
    } else {
        echo "FAIL: Notification not read.\n";
    }

    // 4. Update Profile (Emulate)
    echo "4. Updating Profile...\n";
    $user->update(['name' => 'Updated Name']);
    if ($user->fresh()->name === 'Updated Name') {
        echo "PASS: Profile updated.\n";
    }

    // Cleanup
    $user->delete();
    $note->delete();
    echo "--- Done ---\n";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
