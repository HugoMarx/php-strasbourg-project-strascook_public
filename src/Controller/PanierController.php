<?php

namespace App\Controller;

use App\Model\PanierManager;
use App\Model\ProductManager;
use App\Service\Validation;

class PanierController extends AbstractController
{
    public function index()
    {
        $totalPrice = $this->totalPrice();
        $totalItem = $this->totalItem();

        return $this->twig->render('Panier/index.html.twig', [
            'total_price' => $totalPrice,
            'total_item' => $totalItem
        ]);
    }

    private function totalPrice()
    {
        $priceSum = array();
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                array_push($priceSum, $item['price'] * $item['qte']);
            }
            return array_sum($priceSum);
        }
    }

    private function totalItem()
    {
        $itemSum = array();
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                array_push($itemSum, $item['qte']);
            }

            return array_sum($itemSum);
        }
    }

    public function addPanier()
    {
        $productManager = new PanierManager();
        $cartProducts = $productManager->selectProductById($_GET['id']);

        $cartProducts['qte'] = $_GET['qte'];
        $_SESSION['cart'][] = $cartProducts;


        header('Location: /menu');
    }


    public function empty()
    {
        unset($_SESSION['cart']);
        header('Location: /panier');
    }

    public function edit()
    {
        if (isset($_SESSION['cart'])) {
            if ($_GET['to'] === 'add') {
                $_SESSION['cart'][$_GET['id']]['qte']++;
                header('Location: /panier');
            }

            if ($_GET['to'] === 'del' && $_SESSION['cart'][$_GET['id']]['qte'] > 1) {
                $_SESSION['cart'][$_GET['id']]['qte']--;
                header('Location: /panier');
            }
        }


        header('Location: /panier');
    }

    public function delete()
    {
        unset($_SESSION['cart'][$_GET['id']]);
        header('Location: /panier');
    }

    public function contactForm()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validation  = new Validation();
            $emptyFieldError = $validation->fieldCheck();

            if (empty($emptyFieldError)) {
                $_SESSION['user_details']['lastname'] = $_POST['lastname'];
                $_SESSION['user_details']['firstname'] = $_POST['firstname'];
                $_SESSION['user_details']['email'] = $_POST['email'];
                $_SESSION['user_details']['number'] = $_POST['number'];
                header('Location: /panier/order_recap');
            } else {
                return $this->twig->render(
                    '/Reservation/contact_form.html.twig',
                    ['field_error' => $emptyFieldError]
                );
            }
        }
        return $this->twig->render('/Reservation/contact_form.html.twig');
    }


    public function mailto()
    {

        $panier = $this->twig->render('emails/panier.html.twig', ['cart' => $_SESSION['cart']]);


        $entete  = 'MIME-Version: 1.0' . "\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $entete .= 'From: strascook@monsite.fr' . "\r\n";
        $entete .= 'Reply-to: strascook@monsite.fr';

        $destinataire = 'kutuk.suleymann@gmail.com,' . $_SESSION['user_details']['email'] . '';
        $contenu = ' Merci nous avons bien réceptionner votre commande ' . '<br>';
        $contenu .= '<br>' . 'Nom: ' . $_SESSION['user_details']['lastname'] . '<br>';
        $contenu .= '<br>' . 'Prenom: ' . $_SESSION['user_details']['firstname'] . '<br>';
        $contenu .= '<br>' . 'Adresse: ' . $_SESSION['user_details']['city'] . '<br>';
        $contenu .= '<br>' . 'Code-Postal: ' . $_SESSION['user_details']['post_code'] . '<br>';
        $contenu .= '<br>' . 'E-mail: ' . $_SESSION['user_details']['email'] . '<br>';
        $contenu .= '' . $panier . '<br>';
        $contenu .= "<img 
            src='https://i.ibb.co/FsLK0CW/Logo-Strascook-Alpha.png' width='300px' height='150px'/>";

        mail($destinataire, 'Strascook', $contenu, $entete);
    }





    public function validation()
    {
        return $this->twig->render('Panier/validation.html.twig');
    }





    public function orderRecap()
    {
        $totalPrice = $this->totalPrice();
        $totalItem = $this->totalItem();
        return $this->twig->render(
            'Panier/recap.html.twig',
            [
                'total_price' => $totalPrice,
                'total_item' => $totalItem
            ]
        );
    }

    public function orderConfirmation()
    {
        $panierManager = new PanierManager();
        $panierManager->insertOrder($_SESSION);
        $this->mailto();
        return $this->twig->render('Panier/order_confirmation.html.twig');
    }
}