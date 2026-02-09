<?php

namespace app\Models;

use app\Core\DbModel;
use app\Core\Application;

class Invoice extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public int $client_id = 0;
    public string $invoice_number = '';
    public string $status = 'draft';
    public string $issue_date = '';
    public string $due_date = '';
    public float $subtotal = 0.00;
    public float $tax_rate = 0.00;
    public float $tax_amount = 0.00;
    public float $total = 0.00;
    public string $notes = '';

    public static function tableName(): string
    {
        return 'invoices';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['user_id', 'client_id', 'invoice_number', 'status', 'issue_date', 'due_date', 'subtotal', 'tax_rate', 'tax_amount', 'total', 'notes'];
    }

    public function labels(): array
    {
        return [
            'client_id' => 'Client',
            'invoice_number' => 'Invoice Number',
            'status' => 'Status',
            'issue_date' => 'Issue Date',
            'due_date' => 'Due Date',
            'tax_rate' => 'Tax Rate (%)',
            'notes' => 'Notes',
        ];
    }

    public function rules(): array
    {
        return [
            'client_id' => [self::RULE_REQUIRED],
            'invoice_number' => [self::RULE_REQUIRED],
            'issue_date' => [self::RULE_REQUIRED],
            'due_date' => [self::RULE_REQUIRED],
        ];
    }

    public static function generateNumber(int $userId): string
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM invoices WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $count = (int)$stmt->fetch(\PDO::FETCH_ASSOC)['count'];
        return 'INV-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }

    public static function findByUser(int $userId, ?string $status = null, int $limit = 0): array
    {
        $db = Application::$app->db;
        $sql = "SELECT i.*, c.name as client_name, c.company as client_company, c.email as client_email
                FROM invoices i
                LEFT JOIN clients c ON i.client_id = c.id
                WHERE i.user_id = :user_id";
        $params = ['user_id' => $userId];

        if ($status) {
            $sql .= " AND i.status = :status";
            $params['status'] = $status;
        }

        $sql .= " ORDER BY i.created_at DESC";

        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findByIdWithDetails(int $id): ?array
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT i.*, c.name as client_name, c.company as client_company, c.email as client_email, c.phone as client_phone, c.address as client_address, c.city as client_city, c.country as client_country
            FROM invoices i
            LEFT JOIN clients c ON i.client_id = c.id
            WHERE i.id = :id");
        $stmt->execute(['id' => $id]);
        $invoice = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$invoice) return null;

        $stmt2 = $db->prepare("SELECT ii.*, p.name as product_name FROM invoice_items ii LEFT JOIN products p ON ii.product_id = p.id WHERE ii.invoice_id = :invoice_id");
        $stmt2->execute(['invoice_id' => $id]);
        $invoice['items'] = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

        return $invoice;
    }

    public static function getStats(int $userId): array
    {
        $db = Application::$app->db;

        $stmt = $db->prepare("SELECT COALESCE(SUM(total), 0) as total_revenue FROM invoices WHERE user_id = :uid AND status = 'paid'");
        $stmt->execute(['uid' => $userId]);
        $revenue = $stmt->fetch(\PDO::FETCH_ASSOC)['total_revenue'];

        $stmt = $db->prepare("SELECT COUNT(*) as count FROM invoices WHERE user_id = :uid");
        $stmt->execute(['uid' => $userId]);
        $totalInvoices = $stmt->fetch(\PDO::FETCH_ASSOC)['count'];

        $stmt = $db->prepare("SELECT COUNT(*) as count FROM invoices WHERE user_id = :uid AND status = 'pending'");
        $stmt->execute(['uid' => $userId]);
        $pendingCount = $stmt->fetch(\PDO::FETCH_ASSOC)['count'];

        $stmt = $db->prepare("SELECT COALESCE(SUM(total), 0) as total FROM invoices WHERE user_id = :uid AND status = 'overdue'");
        $stmt->execute(['uid' => $userId]);
        $overdueAmount = $stmt->fetch(\PDO::FETCH_ASSOC)['total'];

        $stmt = $db->prepare("SELECT COUNT(*) as count FROM invoices WHERE user_id = :uid AND status = 'overdue'");
        $stmt->execute(['uid' => $userId]);
        $overdueCount = $stmt->fetch(\PDO::FETCH_ASSOC)['count'];

        $stmt = $db->prepare("SELECT COUNT(*) as count FROM clients WHERE user_id = :uid");
        $stmt->execute(['uid' => $userId]);
        $clientCount = $stmt->fetch(\PDO::FETCH_ASSOC)['count'];

        return [
            'revenue' => (float)$revenue,
            'total_invoices' => (int)$totalInvoices,
            'pending_count' => (int)$pendingCount,
            'overdue_amount' => (float)$overdueAmount,
            'overdue_count' => (int)$overdueCount,
            'client_count' => (int)$clientCount,
        ];
    }

    public function recalculate(): void
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT COALESCE(SUM(total), 0) as subtotal FROM invoice_items WHERE invoice_id = :id");
        $stmt->execute(['id' => $this->id]);
        $this->subtotal = (float)$stmt->fetch(\PDO::FETCH_ASSOC)['subtotal'];
        $this->tax_amount = round($this->subtotal * ($this->tax_rate / 100), 2);
        $this->total = $this->subtotal + $this->tax_amount;

        $db->prepare("UPDATE invoices SET subtotal = :subtotal, tax_amount = :tax_amount, total = :total WHERE id = :id")
            ->execute([
                'subtotal' => $this->subtotal,
                'tax_amount' => $this->tax_amount,
                'total' => $this->total,
                'id' => $this->id,
            ]);
    }
}
