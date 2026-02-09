<?php

use app\Core\Application;

class m0002_create_clients_table
{
    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) DEFAULT NULL,
            phone VARCHAR(50) DEFAULT NULL,
            company VARCHAR(255) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            city VARCHAR(100) DEFAULT NULL,
            country VARCHAR(100) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $db->pdo->exec("DROP TABLE IF EXISTS clients;");
    }
}
