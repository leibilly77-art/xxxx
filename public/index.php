<?php

declare(strict_types=1);

define('XPAY_ROOT', dirname(__DIR__));

if (PHP_SAPI === 'cli-server') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
    $staticFile = __DIR__ . $requestPath;

    if ($requestPath !== '/' && is_file($staticFile)) {
        return false;
    }
}

session_start();

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = XPAY_ROOT . '/app/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path, true, 302);
    exit;
}

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Core\Auth;
use App\Core\Router;

$router = new Router();

$router->get('/', static function (): void {
    redirect(Auth::check() ? '/dashboard' : '/login');
});

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/dashboard', [DashboardController::class, 'dashboard']);
$router->get('/orders', static fn () => (new DashboardController())->emptyPage('orders'));
$router->get('/notify-logs', static fn () => (new DashboardController())->emptyPage('notify-logs'));
$router->get('/payment-logs', static fn () => (new DashboardController())->emptyPage('payment-logs'));
$router->get('/merchants', static fn () => (new DashboardController())->emptyPage('merchants'));
$router->get('/channels', static fn () => (new DashboardController())->emptyPage('channels'));
$router->get('/payment-types', static fn () => (new DashboardController())->emptyPage('payment-types'));
$router->get('/settings', static fn () => (new DashboardController())->emptyPage('settings'));
$router->get('/admins', static fn () => (new DashboardController())->emptyPage('admins'));

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
