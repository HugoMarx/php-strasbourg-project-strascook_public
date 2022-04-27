<?php

namespace App\Controller;

use App\Model\PanierManager;
use App\Model\ProductManager;

class PanierController extends AbstractController
{
    public function index()
    {
        $productManager = new PanierManager();

        $product = [];
        foreach ($_SESSION['id'] as $item) {
            $product[] = $productManager->selectProductById($item);
        }
        return $this->twig->render('Panier/index.html.twig', ['product' => $product]);
    }

    public function addPanier()
    {
        $id = $_GET['id'];
        if (isset($_SESSION['id'])) {
            array_push($_SESSION['id'], $id);
        }

        header('Location: /menu');
    }

    public function edit()
    {
        $productManager = new ProductManager();
        $products = $productManager->selectAll();
        return $this->twig->render('Panier/edit.html.twig', ['products' => $products]);
    }

    public function delete()
    {
        $productManager = new ProductManager();
        $products = $productManager->selectAll();

        return $this->twig->render('Panier/delete.html.twig', ['products' => $products]);
    }
}
