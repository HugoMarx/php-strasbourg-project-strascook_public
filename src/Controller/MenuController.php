<?php

namespace App\Controller;

use App\Model\ProductManager;

class MenuController extends AbstractController
{
    /**
     * Display menu page
     */
    public function menu(): string
    {
        $productManager = new productManager();
        $productsBrut = $productManager->selectAll();

        $products = $images = [];
        foreach ($productsBrut as $product) {
            $images = $productManager->selectAllImages($product['id']);
            $products[$product['id']] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'image' => $images,
                ];
        }

        return $this->twig->render('Menu/menu.html.twig', ['products' => $products]);
    }
}
