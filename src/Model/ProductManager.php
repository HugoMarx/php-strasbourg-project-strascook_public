<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'products';
    public const TABLEIMAGE = 'images';

    public function selectAllImages(int $productId): array
    {
        $statement = $this->pdo->prepare('SELECT I.* FROM products P, images I WHERE P.id=I.product_id and P.id=:id');
        $statement->bindValue('id', $productId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
