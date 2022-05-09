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
                return $this->twig->render('/Reservation/contact_form.html.twig', ['field_error' => $emptyFieldError]);
            }
        }
        return $this->twig->render('/Reservation/contact_form.html.twig');
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
                'total_item' => $totalItem            ]
        );
    }

    public function orderConfirmation(){

        $PanierManager = new PanierManager;
        $PanierManager->insertOrder($_SESSION);

        $user_id = $PanierManager->selectCustomerById($_SESSION);
        var_dump($user_id);

        if( !$PanierManager->insertOrder($_SESSION)){
            return 'Request Failed';
        }

        return $this->twig->render('Panier/order_confirmation.html.twig');
    }

}
