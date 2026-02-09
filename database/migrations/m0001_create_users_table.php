<?php

use app\Core\Application;

class m0001_create_users_table
{
    public function up(): void
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $db->pdo->exec($sql);
    }

    public function down(): void
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE IF EXISTS users;";
        $db->pdo->exec($sql);
    }
}
