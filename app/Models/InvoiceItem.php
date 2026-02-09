<?php

namespace app\Models;

use app\Core\DbModel;
use app\Core\Application;

class InvoiceItem extends DbModel
{
    public int $id = 0;
    public int $invoice_id = 0;
    public ?int $product_id = null;
    public string $description = '';
    public float $quantity = 1;
    public float $unit_price = 0.00;
    public float $total = 0.00;

    public static function tableName(): string
    {
        return 'invoice_items';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['invoice_id', 'product_id', 'description', 'quantity', 'unit_price', 'total'];
    }

    public function labels(): array
    {
        return [
            'description' => 'Description',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
        ];
    }

    public function rules(): array
    {
        return [
            'description' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED],
            'unit_price' => [self::RULE_REQUIRED],
        ];
    }

    public static function findByInvoice(int $invoiceId): array
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT ii.*, p.name as product_name FROM invoice_items ii LEFT JOIN products p ON ii.product_id = p.id WHERE ii.invoice_id = :invoice_id ORDER BY ii.id ASC");
        $stmt->execute(['invoice_id' => $invoiceId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function deleteByInvoice(int $invoiceId): void
    {
        $db = Application::$app->db;
        $db->prepare("DELETE FROM invoice_items WHERE invoice_id = :invoice_id")->execute(['invoice_id' => $invoiceId]);
    }
}
