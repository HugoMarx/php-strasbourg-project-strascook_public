<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'login' => ['LoginController', 'index',],
    'login/check' => ['LoginController', 'loginCheck',],
    'logout' => ['LoginController', 'logout',],
    'backoffice/dashboard' => ['BackOfficeController', 'dashboard'],
    'backoffice/add' => ['BackOfficeController', 'add'],
    'backoffice/delete' => ['BackOfficeController', 'delete'],
    'backoffice/edit' => ['BackOfficeController', 'edit', ['id']],
    'menu' => ['MenuController', 'menu',],
    'menu/add' => ['PanierController', 'addPanier',],
    'form' => ['FormController', 'index',],
    'reservation' => ['ReservationController', 'index',],
    'about' => ['AboutController', 'index',],
    'panier' => ['PanierController', 'index',],
    'panier/delete' => ['PanierController', 'delete',],
    'panier/edit' => ['PanierController', 'edit',],
    'panier/empty' => ['PanierController', 'empty',],
    'panier/contact' => ['PanierController', 'contactForm',],
    'panier/validation' => ['PanierController', 'validation',],
    'panier/mailto' => ['PanierController', 'mailto',],
    'panier/order_recap' => ['PanierController', 'orderRecap',],
    'panier/confirmation' => ['PanierController', 'orderConfirmation',],
];
