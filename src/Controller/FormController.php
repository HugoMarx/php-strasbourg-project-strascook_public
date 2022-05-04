<?php

namespace App\Controller;

class FormController extends AbstractController
{
    public function index()
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

            if (!$errors) {
                $nom = htmlentities($_POST['nom']);
                $prenom = htmlentities($_POST['prenom']);
                $adresse = htmlentities($_POST['adresse']);
                $postal = htmlentities($_POST['postal']);
                $email = htmlentities($_POST['email']);
                $message = htmlentities($_POST['message']);



                $destinataire = '@gmail.com';
                $contenu = '<p>Tu as un nouveau message !</p>';
                $contenu .= '<p><strong>Nom</strong>: ' . $nom . '</p>';
                $contenu .= '<p><strong>Email</strong>: ' . $prenom . '</p>';
                $contenu .= '<p><strong>Message</strong>: ' . $adresse . '</p>';
                $contenu .= '<p><strong>Message</strong>: ' . $postal . '</p>';
                $contenu .= '<p><strong>Message</strong>: ' . $email . '</p>';
                $contenu .= '<p><strong>Message</strong>: ' . $message . '</p>';


                mail($destinataire, 'test', $contenu);
                header("location: /form?message=ok");
            }

            return $this->twig->render('Form/index.html.twig', [
                'errors' => $errors,
                'data' => $_POST
            ]);
        }

        return $this->twig->render('Form/index.html.twig', ['message' => isset($_GET['message'])]);
    }
}
