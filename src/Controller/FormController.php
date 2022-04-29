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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = [];
            if (empty($_POST["nom"] || empty($_POST["prenom"]))) {
                $errors['prenom'] = "Veuillez remplir les champs nom et prenom";
            }
            if (empty($_POST["adresse"])) {
                $errors['adresse'] = "Veuillez remplir le champ adresse";
            }
            if (empty($_POST["postal"])) {
                $errors['postal'] = "Veuillez remplir le champ Code Postal";
            }

            if (empty($_POST["email"])) {
                $errors['email'] = "Veuillez remplir le champ email";
            }


            if (empty($_POST["message"])) {
                $errors['message'] = "Veuillez remplir le champ message";
            }

            if ($errors) {
                return $this->twig->render('Form/index.html.twig', [
                    'errors' => $errors
                ]);
            }
        }

        header("Location: /form");
    }
}
