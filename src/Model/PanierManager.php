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


    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


    public function insertOrder(array $order)
    {
        $userAddress = $order['user_details']['street_num'] . ' '
            . $order['user_details']['street'] . ' ' . $order['user_details']['post_code']
            . ' ' . $order['user_details']['city'];

        $statement = $this->pdo->prepare("INSERT INTO customers (firstname, lastname, adress, email, number) VALUES
        (:firstname, :lastname, :adress, :email, :number)");
        $statement->bindValue('firstname', $order['user_details']['firstname']);
        $statement->bindValue('lastname', $order['user_details']['lastname']);
        $statement->bindValue('adress', $userAddress);
        $statement->bindValue('email', $order['user_details']['email']);
        $statement->bindValue('number', $order['user_details']['number']);
        $statement->execute();

        $customerId = $this->getLastInsertId();

        $statementOrder = $this->pdo->prepare("INSERT INTO user_order (customer_id, status)
        VALUES (:customer_id, true)");
        $statementOrder->bindValue('customer_id', $customerId);
        $statementOrder->execute();

        $orderId = $this->getLastInsertId();

        foreach ($order['cart'] as $product) {
            $statement = $this->pdo->prepare("INSERT INTO order_details (products_id, product_amount, order_id) VALUES
             (:products_id, :product_amount, :order_id)");
            $statement->bindValue('products_id', $product['id']);
            $statement->bindValue('product_amount', $product['qte']);
            $statement->bindValue('order_id', $orderId);
            $statement->execute();
        }
    }
}
