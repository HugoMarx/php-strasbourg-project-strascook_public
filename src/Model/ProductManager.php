<?php

namespace App\Model;

class ProductManager extends AbstractManager
{
    public const TABLE = 'products';
    public const TABLEIMAGE = 'images';
    public const TABLEPT = 'product_type';

    public function selectProductsType(): array
    {
        return $this->pdo->query('SELECT P.*, TP.type FROM products P, ' .
        self::TABLEPT . ' TP WHERE P.product_type_id=TP.id')->fetchAll();
    }

    public function selectAllImages(int $productId): array
    {
        $statement = $this->pdo->prepare('SELECT I.* FROM products P, images I WHERE P.id=I.product_id and P.id=:id');
        $statement->bindValue('id', $productId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectAllType()
    {
        return $this->pdo->query('SELECT * FROM ' . self::TABLEPT)->fetchAll();
    }
}
