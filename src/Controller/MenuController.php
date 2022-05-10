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
        $productsBrut = $productManager->selectProductsType();
        $products = $images = [];
        foreach ($productsBrut as $product) {
            $images = $productManager->selectAllImages($product['id']);
            $products[] = [
                'reference' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'type' => $product['type'],
                'typeid' => $product['product_type_id'],
                'image' => $images,
                ];
        }

        return $this->twig->render(
            'Menu/menu.html.twig',
            ['products' => $products, 'filtres' => $productManager->selectAllType()]
        );
    }
}
