<?php

namespace App\Controller;

class FormController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Form/index.html.twig');
    }

    public function new()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST[""])) {
            }
        }

        header("Location: /form");
    }
}
