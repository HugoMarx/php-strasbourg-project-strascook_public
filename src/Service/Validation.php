<?php

namespace App\Service;

class Validation
{

    public function fileCheck(): array
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

    public function fieldCheck()
    {
        $fieldError = [];

        foreach ($_POST as $key => $value) {
            if ($value === '') {
                $fieldError[] = $key;
            }
        }

        if (isset($_POST['prix'])) {
            if (!is_numeric($_POST['prix']) && !empty($_POST['prix'])) {
                $fieldError[] = 'Le prix doit être un chiffre';
            }
        }

        if (isset($_FILES['images']['name'])) {
            /* if (empty($_FILES['images']['name'])) {
            $fieldError[] = 'Aucune illustration sélectionnée';
        }*/
        }


        return $fieldError;
    }
}
