<?php

namespace App\Controller;

use App\Model\PanierManager;
use App\Model\ProductManager;

class PanierController extends AbstractController
{
    public function index()
    {
        $priceSum = array();
        $itemSum = array();
        $totalPrice = null;
        $totalItem = null;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                array_push($priceSum, $item['price']);
                array_push($itemSum, $item['qte']);
            }
            $totalPrice = array_sum($priceSum);
            $totalItem = array_sum($itemSum);
        }
        return $this->twig->render('Panier/index.html.twig', [
            'total_price' => $totalPrice,
            'total_item' => $totalItem
        ]);
    }

    public function addPanier()
    {
        $productManager = new PanierManager();
        $cartProducts = $productManager->selectProductById($_GET['id']);

        $cartProducts['qte'] = $_GET['qte'];
        $_SESSION['cart'][] = $cartProducts;

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
        unset($_SESSION['cart'][$_GET['id']]);
        header('Location: /panier');
    }
}
