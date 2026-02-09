<?php

namespace app\Models;

use app\Core\DbModel;
use app\Core\Application;

class Product extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public string $name = '';
    public string $description = '';
    public float $price = 0.00;
    public string $unit = 'unit';

    public static function tableName(): string
    {
        return 'products';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['user_id', 'name', 'description', 'price', 'unit'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Product/Service Name',
            'description' => 'Description',
            'price' => 'Price',
            'unit' => 'Unit',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
        ];
    }

    public static function findByUser(int $userId): array
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM products WHERE user_id = :user_id ORDER BY name ASC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
