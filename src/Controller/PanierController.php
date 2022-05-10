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

        $panier = '<table>';
        $panier .= '<thead>';
        $panier .= '<tr>';
        $panier .= '<td>Plat</td>';
        $panier .= '<td>price</td>';
        $panier .= '<td>qte</td>';
        $panier .= '</tr>';
        $panier .= '</thead>';
        $panier .= '<tbody>';
        foreach ($_SESSION['cart'] as $product) {
            $panier .= '<tr>';
            $panier .= '<td>' . $product['name'] . '</td>';
            $panier .= '<td>' . $product['price'] . '</td>';
            $panier .= '<td>' . $product['qte'] . '</td>';
            $panier .= '</tr>';
        }
        $panier .= '</tbody>';
        $panier .= '</table>';

        $entete  = 'MIME-Version: 1.0' . "\r\n";
        $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $entete .= 'From: strascook@monsite.fr' . "\r\n";
        $entete .= 'Reply-to: strascook@monsite.fr';

        $destinataire = 'kutuk.suleymann@gmail.com';
        $contenu = ' Merci nous avons bien recu votre commande !' . '<br>';
        $contenu .= 'Nom: ' . $_SESSION['user_details']['lastname'] . '<br>';
        $contenu .= 'Prenom: ' . $_SESSION['user_details']['firstname'] . '<br>';
        $contenu .= 'Adresse: ' . $_SESSION['user_details']['city'] . '<br>';
        $contenu .= 'Code-Postal: ' . $_SESSION['user_details']['post_code'] . '<br>';
        $contenu .= 'E-mail: ' . $_SESSION['user_details']['email'] . '<br>';
        $contenu .= 'Message: <br/>' . $panier . '<br>';
        $contenu .= "<img 
            src='https://i.ibb.co/FsLK0CW/Logo-Strascook-Alpha.png' width='300px' height='150px'/>";

        mail($destinataire, 'Strascook', $contenu, $entete);

        header('Location: /panier/order_recap?message=ok');
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
}
