<?php
namespace App\Controller;

class ReservationController extends AbstractController {

    public function index():string {

        return $this->twig->render('/Reservation/date_place_check.html.twig');
    }


}

