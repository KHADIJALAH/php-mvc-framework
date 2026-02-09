<?php

use app\Core\Application;

class m0004_create_invoices_table
{
    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS invoices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            client_id INT NOT NULL,
            invoice_number VARCHAR(50) NOT NULL,
            status ENUM('draft','pending','paid','overdue') DEFAULT 'draft',
            issue_date DATE NOT NULL,
            due_date DATE NOT NULL,
            subtotal DECIMAL(10,2) DEFAULT 0.00,
            tax_rate DECIMAL(5,2) DEFAULT 0.00,
            tax_amount DECIMAL(10,2) DEFAULT 0.00,
            total DECIMAL(10,2) DEFAULT 0.00,
            notes TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $db->pdo->exec("DROP TABLE IF EXISTS invoices;");
    }
}
