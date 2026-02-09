<?php

namespace app\Models;

use app\Core\DbModel;
use app\Core\Application;

class Client extends DbModel
{
    public int $id = 0;
    public int $user_id = 0;
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $address = '';
    public string $city = '';
    public string $country = '';

    public static function tableName(): string
    {
        return 'clients';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['user_id', 'name', 'email', 'phone', 'company', 'address', 'city', 'country'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Client Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'company' => 'Company',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL],
        ];
    }

    public static function findByUser(int $userId): array
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT * FROM clients WHERE user_id = :user_id ORDER BY name ASC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function countByUser(int $userId): int
    {
        $db = Application::$app->db;
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM clients WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return (int)$stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}
