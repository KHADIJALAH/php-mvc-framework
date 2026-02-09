<?php

namespace app\Controllers;

use app\Core\Application;
use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\User;
use app\Middleware\AuthMiddleware;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('main');

        // Get some statistics
        $users = User::findAll();
        $totalUsers = count($users);

        return $this->renderWithLayout('dashboard/index', [
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'user' => Application::$app->user
        ]);
    }

    public function users(Request $request, Response $response): string
    {
        $this->setLayout('main');
        $users = User::findAll();

        return $this->renderWithLayout('dashboard/users', [
            'title' => 'Users',
            'users' => $users
        ]);
    }
}
