<?php

namespace app\Controllers;

use app\Core\Controller;
use app\Core\Request;
use app\Core\Response;
use app\Core\Application;
use app\Middleware\AuthMiddleware;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function index(Request $request, Response $response): string
    {
        $this->setLayout('app');
        $userId = Application::$app->user->id;
        $db = Application::$app->db;

        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $stmt = $db->prepare("SELECT COALESCE(SUM(total), 0) as revenue FROM invoices WHERE user_id = :uid AND status = 'paid' AND DATE_FORMAT(issue_date, '%Y-%m') = :month");
            $stmt->execute(['uid' => $userId, 'month' => $month]);
            $monthlyRevenue[] = ['month' => date('M Y', strtotime("-$i months")), 'revenue' => (float)$stmt->fetch(\PDO::FETCH_ASSOC)['revenue']];
        }

        $stmt = $db->prepare("SELECT status, COUNT(*) as count, COALESCE(SUM(total), 0) as total FROM invoices WHERE user_id = :uid GROUP BY status");
        $stmt->execute(['uid' => $userId]);
        $statusBreakdown = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT c.name as client_name, c.company, COALESCE(SUM(i.total), 0) as total_revenue, COUNT(i.id) as invoice_count FROM clients c LEFT JOIN invoices i ON c.id = i.client_id AND i.status = 'paid' WHERE c.user_id = :uid GROUP BY c.id ORDER BY total_revenue DESC LIMIT 5");
        $stmt->execute(['uid' => $userId]);
        $topClients = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->renderWithLayout('reports/index', [
            'title' => 'Reports', 'monthlyRevenue' => $monthlyRevenue, 'statusBreakdown' => $statusBreakdown, 'topClients' => $topClients, 'activePage' => 'reports',
        ]);
    }
}
