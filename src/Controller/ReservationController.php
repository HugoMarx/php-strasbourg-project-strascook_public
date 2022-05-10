<?php

namespace App\Controller;

use DateTime;
use DateTimeZone;
use App\Service\Validation;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        $limiteDate = $this->getLimiteDate();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validation = new Validation();
            $error = [];
            $emptyFieldError = $validation->fieldCheck();

            if (!empty($this->placeCheck()) && !empty($this->dateCheck())) {
                $error = array_merge($this->placeCheck(), $this->dateCheck());
            } elseif (empty($this->placeCheck())) {
                $error = $this->dateCheck();
            } else {
                $error = $this->placeCheck();
            }

            if (empty($error)) {
                $_SESSION['user_details'] = array(
                    'reservation_date' => $_POST['date'],
                    'city' => $_POST['city'],
                    'street' => $_POST['street'],
                    'street_num' => $_POST['home_number'],
                    'post_code' => $_POST['post_code']
                );

                header('Location: /menu?message=ok');

                if ($_GET) {
                    if ($_GET['from'] === 'validation' || $_GET['from'] === 'cart') {
                        header('Location: /panier/validation');
                    }
                } else {
                    header('Location: /menu');
                }
              
            } else {
                return $this->twig->render('/Reservation/date_place_check.html.twig', [
                    'error' => $error,
                    'empty_fields' => $emptyFieldError,
                    'limite_date' => $limiteDate
                ]);
            }
        }
        return $this->twig->render('/Reservation/date_place_check.html.twig', ['limite_date' => $limiteDate]);
    }


    public function placeCheck(): ?array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validPostCode = [67000, 67100, 67200];
            $error = [];

            if (in_array($_POST['post_code'], $validPostCode)) {
                return $error = [];
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
            $limiteDate = $this->getLimiteDate();
            if ($_POST['date'] >= $limiteDate) {
                return $error = [];
            } else {
                $error['invalid_date'] = 'Merci de choisir une date ultérieure 📆';
                return $error;
            }
        }

        return null;
    }

    private function getLimiteDate()
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        return $date->modify('+3 days')->format('Y-m-d');
    }
}
