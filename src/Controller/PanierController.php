<?php

namespace App\Controller;

use App\Model\PanierManager;
use App\Model\ProductManager;

class PanierController extends AbstractController
{
    public function index()
    {
        $productManager = new PanierManager();

        $products = [];
        $priceSum = [];
        $totalPrice = null;
        $itemSum = array();
        $totalItem = null;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
                $products[] = $productManager->selectProductById($item['item_id']);
                array_push($priceSum, $products[$id]['price']);
                array_push($itemSum, $item['qte']);
            }

            $totalPrice = array_sum($priceSum);
            $totalItem = array_sum($itemSum);
        }
        var_dump($_SESSION);
        var_dump($totalItem);
        return $this->twig->render('Panier/index.html.twig', [
            'products' => $products,
            'total_price' => $totalPrice,
            'total_item' => $totalItem
        ]);
    }

    public function addPanier()
    {


        $_SESSION['cart'][] = array('item_id' => $_GET['id'], 'qte' => 1);

        header('Location: /menu');
    }


    public function empty()
    {
        unset($_SESSION['cart']);
        header('Location: /panier');
    }

    public function edit()
    {


        return $this->twig->render('Panier/edit.html.twig');
    }

    public function delete()
    {
        return $this->twig->render('Panier/delete.html.twig');
    }
}
