<?php

namespace App\Model;

use App\Model\AbstractManager;

class BOItemManager extends AbstractManager
{
    public const TABLE = 'products';


    public function selectAllProducts(string $orderBy = 'name', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function insertProduct(array $item): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            "(name, price, status, product_type_id, description)
            VALUES (:name, :price, :status, :product_type_id, :description)");
        $statement->bindValue(':name', $item['name']);
        $statement->bindValue(':price', $item['prix']);
        //$statement->bindValue('image', $item['image']);
        $statement->bindValue(':status', $item['status']);
        $statement->bindValue(':product_type_id', $item['type']);
        $statement->bindValue(':description', $item['description']);
        $statement->execute();
    }

    public function updateProduct(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET name = :name, price = :price, status = :status,
            product_type_id = :product_type_id, description = :description
        WHERE id= :id");
        $statement->bindValue('name', $item['name']);
        $statement->bindValue('price', $item['prix']);
        $statement->bindValue('status', $item['status']);
        $statement->bindValue('product_type_id', $item['type']);
        $statement->bindValue('description', $item['description']);
        $statement->bindValue('id', $item['id']);
        return $statement->execute();
    }


    public function deleteProduct(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id);
        $statement->execute();
    }
}
