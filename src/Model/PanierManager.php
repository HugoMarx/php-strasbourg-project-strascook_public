<?php

namespace App\Model;

class PanierManager extends AbstractManager
{
    public const TABLE = 'products';

    public function selectAllProducts(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectProductById(string $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT products.id, name, price,
        status, type, description FROM " . static::TABLE . "
        JOIN product_type ON product_type.id = products.product_type_id
        WHERE products.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
