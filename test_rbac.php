<?php

use App\Models\User;
use App\Services\Core\RoleService;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = new RoleService();

try {
    echo "Creating Test User...\n";
    $user = User::create([
        'name' => 'RBAC Tester',
        'email' => 'rbac@test.com',
        'password' => Hash::make('secret'),
    ]);
    echo "User Created: " . $user->id . "\n";

    echo "Assigning Admin Role...\n";
    $service->assignRole($user, RoleService::ROLE_ADMIN);
    echo "Roles: " . implode(', ', $user->roles) . "\n";

    echo "Verifying hasRole('admin')...\n";
    if ($user->hasRole('admin')) {
        echo "PASSED: User has admin role.\n";
    } else {
        echo "FAILED: User missing admin role.\n";
    }

    echo "Cleanup...\n";
    $user->delete();

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
