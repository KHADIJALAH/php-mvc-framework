<?php

use app\Core\Application;

/**
 * Redirect to a URL
 */
function redirect(string $url): void
{
    header("Location: $url");
    exit;
}

/**
 * Get the current user
 */
function user(): ?app\Core\User
{
    return Application::$app->user;
}

/**
 * Check if user is authenticated
 */
function auth(): bool
{
    return !Application::isGuest();
}

/**
 * Get flash message
 */
function flash(string $key): string
{
    return Application::$app->session->getFlash($key);
}

/**
 * Check if flash message exists
 */
function hasFlash(string $key): bool
{
    return Application::$app->session->hasFlash($key);
}

/**
 * Set flash message
 */
function setFlash(string $key, string $message): void
{
    Application::$app->session->setFlash($key, $message);
}

/**
 * Get old input value
 */
function old(string $key, string $default = ''): string
{
    return Application::$app->session->get("old_$key", $default);
}

/**
 * Escape HTML
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Generate CSRF token
 */
function csrf_token(): string
{
    if (!Application::$app->session->get('csrf_token')) {
        Application::$app->session->set('csrf_token', bin2hex(random_bytes(32)));
    }
    return Application::$app->session->get('csrf_token');
}

/**
 * Generate CSRF field
 */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

/**
 * Asset URL helper
 */
function asset(string $path): string
{
    return '/' . ltrim($path, '/');
}

/**
 * URL helper
 */
function url(string $path): string
{
    return '/' . ltrim($path, '/');
}

/**
 * Format date
 */
function formatDate(string $date, string $format = 'M d, Y'): string
{
    return date($format, strtotime($date));
}
