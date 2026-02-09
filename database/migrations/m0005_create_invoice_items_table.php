<?php

use app\Core\Application;

class m0005_create_invoice_items_table
{
    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS invoice_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            invoice_id INT NOT NULL,
            product_id INT DEFAULT NULL,
            description VARCHAR(255) NOT NULL,
            quantity DECIMAL(10,2) NOT NULL DEFAULT 1,
            unit_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $db->pdo->exec("DROP TABLE IF EXISTS invoice_items;");
    }
}
