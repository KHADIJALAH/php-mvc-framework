<?php

/**
 * PHP MVC Framework
 * Entry point for all requests
 */

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Autoloader
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load configuration
$config = require BASE_PATH . '/config/app.php';

// Start session
session_start();

// Load helpers
require BASE_PATH . '/app/Core/helpers.php';

// Initialize Application
$app = new app\Core\Application($config);

// Load routes
require BASE_PATH . '/routes/web.php';

// Run the application
$app->run();
