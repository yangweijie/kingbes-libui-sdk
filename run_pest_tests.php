<?php

/**
 * Run Pest tests
 */

require __DIR__ . '/vendor/autoload.php';

echo "Running Pest tests...\n";

// Run Pest tests
passthru('php vendor/pestphp/pest/bin/pest --configuration phpunit.xml', $exitCode);

exit($exitCode);