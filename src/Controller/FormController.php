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



                $entete  = 'MIME-Version: 1.0' . "\r\n";
                $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $entete .= 'From: webmaster@monsite.fr' . "\r\n";
                $entete .= 'Reply-to: kutuk.suleymann@gmail.com';

                $destinataire = 'kutuk.suleymann@gmail.com';
                $contenu = 'Tu as une nouvelle demande !' . '<br>';
                $contenu .= 'Nom: ' . $nom . '<br>';
                $contenu .= 'Prenom: ' . $prenom . '<br>';
                $contenu .= 'Adresse: ' . $adresse . '<br>';
                $contenu .= 'Code-Postal: ' . $postal . '<br>';
                $contenu .= 'E-mail: ' . $email . '<br>';
                $contenu .= 'Message: ' . $message . '<br>';
                $contenu .= "<img 
                src='https://i.ibb.co/FsLK0CW/Logo-Strascook-Alpha.png' width='300px' height='150px'/>";


                mail($destinataire, 'Strascook', $contenu, $entete);
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
