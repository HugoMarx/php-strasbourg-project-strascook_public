<?php

namespace App\Controller;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        return $this->twig->render('Back_office/dashboard.html.twig');
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
                return  $this->twig->render('Back_office/add_item.html.twig',['error' => $error]);
            }
        } else {
            return $this->twig->render('Back_office/add_item.html.twig');
        }
    }
}
