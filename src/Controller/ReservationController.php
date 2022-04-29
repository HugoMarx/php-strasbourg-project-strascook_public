<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = [];
            if (!empty($this->placeCheck()) && !empty($this->dateCheck())) {
                $error = array_merge($this->placeCheck(), $this->dateCheck());
            } elseif (empty($this->placeCheck())) {
                $error = $this->dateCheck();
            } elseif (empty($this->dateCheck())) {
                $error = $this->placeCheck();
            }
            var_dump($error);


            if (empty($error)) {
                header('Location: /menu');
            } else {
                return $this->twig->render('/Reservation/date_place_check.html.twig', ['error' => $error]);
            }
        }
        return $this->twig->render('/Reservation/date_place_check.html.twig');
    }

    public function placeCheck(): ?array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validPostCode = [67000, 67100, 67200];
            $error = [];

            if (in_array($_POST['post_code'], $validPostCode)) {
                $_SESSION['street_name'] = $_POST['street'];
                $_SESSION['city'] = $_POST['city'];
                $_SESSION['home_number'] = $_POST['home_number'];
            } else {
                $error['invalid_place'] =
                    ' Désolé, le chef ne se déplace par encore dans cette zone,
                    veuillez entrer une adresse à Strasbourg 🚩';
                return $error;
            }
        }

        return null;
    }

    public function dateCheck()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $limiteDate = $date->modify('+2 days')->format('Y-m-d');
            $error = [];
            if ($_POST['date'] >= $limiteDate) {
                $_SESSION['date'] = $_POST['date'];
            } else {
                $error['invalid_date'] = 'Merci de choisir une date ultérieure 📆';
                return $error;
            }
        }

        return null;
    }
}
