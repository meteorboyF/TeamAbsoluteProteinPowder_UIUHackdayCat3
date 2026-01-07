<?php

use App\Services\Core\SettingService;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = new SettingService();

try {
    echo "Setting 'site_name'...\n";
    $service->set('site_name', 'TALL Stack SaaS');

    echo "Retrieving 'site_name'...\n";
    $val = $service->get('site_name');
    echo "Value: " . $val . "\n";

    if ($val === 'TALL Stack SaaS') {
        echo "PASSED!\n";
    } else {
        echo "FAILED!\n";
    }

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
