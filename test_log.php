<?php

use App\Models\Log;
use App\Services\Core\LogService;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = new LogService();

try {
    echo "Creating Log...\n";
    $log = $service->log('Test Log Entry', ['foo' => 'bar']);
    echo "Log Created: " . $log->id . "\n";

    echo "Verifying Log...\n";
    $found = Log::find($log->id);
    if ($found && $found->description === 'Test Log Entry') {
        echo "VERIFICATION PASSED!\n";
    } else {
        echo "VERIFICATION FAILED!\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
