<?php

namespace App\Controller;

use App\Model\LoginManager;

class LoginController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $message = (isset($_GET['message'])) ? $_GET['message'] : '';



        return $this->twig->render(
            'Login/index.html.twig',
            [
                'message' => $message,
                'user' => $_SESSION['login'],
            ]
        );
    }



    public function loginCheck()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new LoginManager();
            $login = $user->selectOneByIdUserPass($_POST);
            if ($login) {
                $_SESSION['login'] = $login['user_name'];
                header('location: /admin');
                return;
            }
            header('location:/login?message=nop');
        }
    }
}
