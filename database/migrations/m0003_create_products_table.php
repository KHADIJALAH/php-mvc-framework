<?php

use app\Core\Application;

class m0003_create_products_table
{
    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            description TEXT DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            unit VARCHAR(50) DEFAULT 'unit',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $db->pdo->exec("DROP TABLE IF EXISTS products;");
    }
}
