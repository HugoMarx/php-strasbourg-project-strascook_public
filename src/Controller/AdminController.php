<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    public function dashboard()
    {
        return $this->twig->render('Back_office/dashboard.html.twig');
    }
}
