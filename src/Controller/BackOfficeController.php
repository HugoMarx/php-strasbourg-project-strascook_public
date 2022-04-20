<?php

namespace App\Controller;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        return $this->twig->render('Back_office/dashboard.html.twig');
    }

    public function add(): string
    {

        return $this->twig->render('Back_office/add_item.html.twig');
    }
}
