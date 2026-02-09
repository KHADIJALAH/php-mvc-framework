<?php

use app\Controllers\HomeController;
use app\Controllers\AuthController;
use app\Controllers\DashboardController;
use app\Controllers\InvoiceController;
use app\Controllers\ClientController;
use app\Controllers\ProductController;
use app\Controllers\ReportController;
use app\Core\Application;

$app = Application::$app;

// Home - redirect to dashboard or login
$app->router->get('/', [HomeController::class, 'index']);

// Auth routes
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'loginPost']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'registerPost']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);
$app->router->post('/profile', [AuthController::class, 'profileUpdate']);
$app->router->get('/settings', [AuthController::class, 'settings']);
$app->router->post('/settings', [AuthController::class, 'settingsUpdate']);

// Dashboard
$app->router->get('/dashboard', [DashboardController::class, 'index']);

// Invoices
$app->router->get('/invoices', [InvoiceController::class, 'index']);
$app->router->get('/invoices/create', [InvoiceController::class, 'create']);
$app->router->post('/invoices', [InvoiceController::class, 'store']);
$app->router->get('/invoices/{id}', [InvoiceController::class, 'show']);
$app->router->get('/invoices/{id}/edit', [InvoiceController::class, 'edit']);
$app->router->post('/invoices/{id}/update', [InvoiceController::class, 'update']);
$app->router->post('/invoices/{id}/delete', [InvoiceController::class, 'delete']);
$app->router->post('/invoices/{id}/status', [InvoiceController::class, 'updateStatus']);

// Clients
$app->router->get('/clients', [ClientController::class, 'index']);
$app->router->get('/clients/create', [ClientController::class, 'create']);
$app->router->post('/clients', [ClientController::class, 'store']);
$app->router->get('/clients/{id}', [ClientController::class, 'show']);
$app->router->get('/clients/{id}/edit', [ClientController::class, 'edit']);
$app->router->post('/clients/{id}/update', [ClientController::class, 'update']);
$app->router->post('/clients/{id}/delete', [ClientController::class, 'delete']);

// Products
$app->router->get('/products', [ProductController::class, 'index']);
$app->router->get('/products/create', [ProductController::class, 'create']);
$app->router->post('/products', [ProductController::class, 'store']);
$app->router->get('/products/{id}/edit', [ProductController::class, 'edit']);
$app->router->post('/products/{id}/update', [ProductController::class, 'update']);
$app->router->post('/products/{id}/delete', [ProductController::class, 'delete']);

// Reports
$app->router->get('/reports', [ReportController::class, 'index']);
