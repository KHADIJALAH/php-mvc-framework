<?php

/**
 * Database Migration Script
 * Run: php migrate.php
 */

define('BASE_PATH', __DIR__);

// Autoloader
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load configuration
$config = require BASE_PATH . '/config/app.php';

// Load helpers
require BASE_PATH . '/app/Core/helpers.php';

use app\Core\Application;

$app = new Application($config);

echo "Running migrations..." . PHP_EOL;
$app->db->applyMigrations();
echo "Done!" . PHP_EOL;
