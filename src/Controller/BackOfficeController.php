<?php

namespace App\Controller;

use App\Model\BOItemManager;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        $productsManager = new BOItemManager();
        $products = $productsManager->selectAllProducts();
        return $this->twig->render('Back_office/dashboard.html.twig', ['products' => $products]);
    }





    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO validations (length, format...)
            $fieldError = $this->fieldCheck();
            $fileError = $this->fileCheck();

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


    public function edit(int $id): ?string
    {
        // clean $_POST data
        $id = $_GET['id'];
        $productsManager = new BOItemManager();
        $product = $productsManager->selectOneById($id);
        // TODO validations (length, format...)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fieldError = $this->fieldCheck();
            $fileError = $this->fileCheck();

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


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $productManager = new BOItemManager();
            $productManager->delete($_GET['id']);

            header('Location: /backoffice/dashboard');
        }
    }

    private function fileCheck(): array
    {
        $fileError = [];
        if (!empty($_FILES['images']['name'])) {
            $valideExtensions = ['jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'webp'];
            $fileExtension = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
            $maxFileSize = 2097152;

            if ($_FILES['images']['size'] > $maxFileSize) {
                $fileError[] = 'Le fichier ne peut dépasser 2MB';
            }

            if (!in_array($fileExtension, $valideExtensions)) {
                $fileError[] =  'Cette extension de fichier n\'est pas prise en charge';
            }
        }

        return $fileError;
    }

    private function fieldCheck()
    {
        $fieldError = [];

        foreach ($_POST as $key => $value) {
            if ($value === '') {
                $fieldError[] = $key;
            }
        }

        if (!is_numeric($_POST['prix']) && !empty($_POST['prix'])) {
            $fieldError[] = 'Le prix doit être un chiffre';
        }

        /* if (empty($_FILES['images']['name'])) {
            $fieldError[] = 'Aucune illustration sélectionnée';
        }*/

        return $fieldError;
    }
}
