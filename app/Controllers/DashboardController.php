<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;
use app\Models\Invoice;
use app\Middleware\AuthMiddleware;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $userId = Application::$app->user->id;
        $stats = Invoice::getStats($userId);
        $recentInvoices = Invoice::findByUser($userId, null, 5);

        return $this->renderWithLayout('dashboard/index', [
            'title' => 'Dashboard',
            'stats' => $stats,
            'recentInvoices' => $recentInvoices,
            'activePage' => 'dashboard',
        ]);
    }
}
