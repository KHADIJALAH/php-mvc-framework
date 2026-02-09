<?php

use app\Controllers\HomeController;
use app\Controllers\AuthController;
use app\Controllers\DashboardController;
use app\Core\Application;

$app = Application::$app;

// Public routes
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/about', [HomeController::class, 'about']);
$app->router->get('/contact', [HomeController::class, 'contact']);
$app->router->post('/contact', [HomeController::class, 'contactPost']);

// Auth routes
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'loginPost']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'registerPost']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

// Dashboard routes (protected)
$app->router->get('/dashboard', [DashboardController::class, 'index']);
$app->router->get('/dashboard/users', [DashboardController::class, 'users']);
