<?php

namespace App\Controller;

use App\Model\BOItemManager;
use App\Service\Validation;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        if (isset($_SESSION['login'])) {
            $productsManager = new BOItemManager();
            $products = $productsManager->selectAllProducts();
            $orders = $productsManager->selectAllOrders('order_id', 'ASC');
            return $this->twig->render(
                'Back_office/dashboard.html.twig',
                [
                    'products' => $products, 'orders' => $orders
                ]
            );
        }

        return $this->twig->render('Login/index.html.twig');
    }

    public function add(): string
    {
        if (isset($_SESSION['login'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $validation = new Validation();
                // TODO validations (length, format...)
                $fieldError = $validation->fieldCheck();
                $fileError = $validation->fileCheck();

                if (/*$_FILES['images']['error'] === 0 && */count($fieldError) === 0 && count($fileError) === 0) {
                    $file = uniqid() . $_FILES['images']['name'];
                    $uploadDir = 'C:\Users\hugo_dev\Desktop\upload_test\\';
                    $uploadPath = $uploadDir . $file;
                    move_uploaded_file($_FILES['images']['tmp_name'], $uploadPath);
                    $fileIsValid = true;

                    // if validation is ok, insert and redirection

                    // clean $_POST data
                    $product = array_map('trim', $_POST);

                    $productsManager = new BOItemManager();
                    $productsManager->insertProduct($product);

                    return $this->twig->render(
                        'Back_office/add_item.html.twig',
                        ['fileIsValid' => $fileIsValid]
                    );
                } else {
                    return  $this->twig->render(
                        'Back_office/add_item.html.twig',
                        ['fieldError' => $fieldError, 'fileError' => $fileError]
                    );
                }
            }

            return $this->twig->render('Back_office/add_item.html.twig');
        }

        return $this->twig->render('Login/index.html.twig');
    }


    public function edit(int $id): ?string
    {

        if (isset($_SESSION['login'])) {
            // clean $_POST data
            $id = $_GET['id'];
            $productsManager = new BOItemManager();
            $product = $productsManager->selectOneById($id);
            // TODO validations (length, format...)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $validation = new Validation();
                $fieldError = $validation->fieldCheck();
                $fileError = $validation->fileCheck();

                if (/*$_FILES['images']['error'] === 0 && */count($fieldError) === 0 && count($fileError) === 0) {
                    /*$file = uniqid() . $_FILES['images']['name'];
                    $uploadDir = 'C:\Users\hugo_dev\Desktop\upload_test\\';
                    $uploadPath = $uploadDir . $file;
                    move_uploaded_file($_FILES['images']['tmp_name'], $uploadPath);
                    $fileIsValid = true;*/

                    // if validation is ok, insert and redirection

                    // clean $_POST data
                    $product = array_map('trim', $_POST);
                    $productsManager->updateProduct($product);
                    header('Location: /backoffice/dashboard');
                } else {
                    return  $this->twig->render(
                        'Back_office/edit_item.html.twig',
                        ['fieldError' => $fieldError, 'fileError' => $fileError, 'product' => $product]
                    );
                }
            }

            return $this->twig->render('Back_office/edit_item.html.twig', [
                'product' => $product
            ]);
        }

        return $this->twig->render('Login/index.html.twig');
    }

    public function delete()
    {
        if (isset($_SESSION['login'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $productManager = new BOItemManager();
                $productManager->delete($_GET['id']);

                header('Location: /backoffice/dashboard');
            }
        }

        return $this->twig->render('Login/index.html.twig');
    }
}
