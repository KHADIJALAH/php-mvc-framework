<?php

namespace app\Core;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save(): bool
    {
        $tableName = static::tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = Application::$app->db->prepare(
            "INSERT INTO $tableName (" . implode(',', $attributes) . ")
             VALUES (" . implode(',', $params) . ")"
        );

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function update(): bool
    {
        $tableName = static::tableName();
        $attributes = $this->attributes();
        $primaryKey = static::primaryKey();

        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);

        $statement = Application::$app->db->prepare(
            "UPDATE $tableName SET " . implode(',', $params) . " WHERE $primaryKey = :pk"
        );

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->bindValue(':pk', $this->{$primaryKey});

        $statement->execute();
        return true;
    }

    public function delete(): bool
    {
        $tableName = static::tableName();
        $primaryKey = static::primaryKey();

        $statement = Application::$app->db->prepare(
            "DELETE FROM $tableName WHERE $primaryKey = :pk"
        );
        $statement->bindValue(':pk', $this->{$primaryKey});

        $statement->execute();
        return true;
    }

    public static function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = Application::$app->db->prepare(
            "SELECT * FROM $tableName WHERE $sql"
        );

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function findAll(array $where = []): array
    {
        $tableName = static::tableName();

        if (empty($where)) {
            $statement = Application::$app->db->prepare("SELECT * FROM $tableName");
        } else {
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $sql");

            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
        }

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    public static function findById($id)
    {
        return static::findOne([static::primaryKey() => $id]);
    }
}
