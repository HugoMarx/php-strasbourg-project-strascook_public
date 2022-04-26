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
        $products = $productManager->selectAll();

        return $this->twig->render('Menu/menu.html.twig', ['products' => $products]);
    }
}
