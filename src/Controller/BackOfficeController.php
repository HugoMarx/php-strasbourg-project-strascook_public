<?php

namespace App\Controller;

use App\Model\BOItemManager;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        $productsManager = new BOItemManager();
        $products = $productsManager->selectAll();
        return $this->twig->render('Back_office/dashboard.html.twig', ['products' => $products]);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            $error = [];
            foreach ($_POST as $key => $value) {
                if (!$value) {
                    $error[] = $key;
                }
            }
            if (count($error) === 0) {
                return $this->twig->render('Back_office/dashboard.html.twig');
            } else {
                return  $this->twig->render('Back_office/add_item.html.twig', ['error' => $error]);
            }
        } else {
            return $this->twig->render('Back_office/add_item.html.twig');
        }
    }
}
