<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'backoffice/dashboard' => ['BackOfficeController', 'dashboard'],
    'backoffice/add' => ['BackOfficeController', 'add'],
    'backoffice/delete' => ['BackOfficeController', 'delete'],
    'backoffice/edit' => ['BackOfficeController', 'edit', ['id']],
    'menu' => ['MenuController', 'menu',],
    'menu/add' => ['PanierController', 'addPanier',],
    'form' => ['FormController', 'index',],
    'form/new' => ['FormController', 'new',],
    'Home/index' => ['HomeController', 'index',],
    'reservation' => ['ReservationController', 'index',],
    'panier' => ['PanierController', 'index',],



];
