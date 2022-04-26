<?php

namespace App\Controller;

use App\Model\BOItemManager;

class BackOfficeController extends AbstractController
{
    public function dashboard(): string
    {
        $productsManager = new BOItemManager();
        $products = $productsManager->selectAll();
        return $this->twig->render('Back_office/dashboard.html.twig', ['products' => $products]);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST);
            var_dump($_FILES);
            $fieldError = [];
            $fileError = $this->fileCheck();

            foreach ($_POST as $key => $value) {
                if (!$value) {
                    $fieldError[] = $key;
                }
            }

            if (!is_numeric($_POST['prix']) && !empty($_POST['prix'])) {
                $fieldError[] = 'Le prix doit être un chiffre';
            }


            if ($_FILES['images']['error'] === 0 && count($fieldError) === 0 && count($fileError) === 0) {
                $file = uniqid() . $_FILES['images']['name'];
                $uploadDir = 'C:\Users\hugo_dev\Desktop\upload_test\\';
                $uploadPath = $uploadDir . $file;
                move_uploaded_file($_FILES['images']['tmp_name'], $uploadPath);
                $fileIsValid = true;
                return $this->twig->render('Back_office/add_item.html.twig', ['fileIsValid' => $fileIsValid]);
            } else {
                return  $this->twig->render(
                    'Back_office/add_item.html.twig',
                    ['fieldError' => $fieldError, 'fileError' => $fileError]
                );
            }
        }
        return $this->twig->render('Back_office/add_item.html.twig');
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
}
