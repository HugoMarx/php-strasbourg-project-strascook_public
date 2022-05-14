<?php

namespace App\Controller;

use App\Model\LoginManager;

class LoginController extends AbstractController
{
    /**
     * Display home page
     */
    public function index()
    {
        $message = (isset($_GET['message'])) ? $_GET['message'] : '';

        if (isset($_SESSION['login'])) {
            header('location: /backoffice/dashboard');
        } else {
            return $this->twig->render(
                'Login/index.html.twig',
                [
                    'message' => $message,
                ]
            );
        }
    }


    public function loginCheck()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new LoginManager();
            $login = $user->selectOneByIdUserPass($_POST);
            if ($login) {
                $_SESSION['login'] = $login['user_name'];
                header('location: /backoffice/dashboard');
                return;
            }
            header('location:/login?message=incorrect');
        }
    }

    public function logout()
    {

        unset($_SESSION['login']);
        header('location: /');
    }
}
