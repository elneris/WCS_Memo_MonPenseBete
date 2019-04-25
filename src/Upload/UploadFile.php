<?php

namespace App\Upload;

class UploadFile
{

    const ERROR  = [
        0 => "Aucune erreur, OK",
        1 => "La taille du picture téléchargé excède la valeur 
              de upload_max_filesize, configurée dans le php.ini",
        2 => "La taille du picture téléchargé excède la valeur de max",
        3 => "Le picture n'a été que partiellement téléchargé.",
        4 => "Aucun picture n'a été téléchargé.",
        6 => "Un dossier temporaire est manquant.",
        7 => "Échec de l'écriture du picture sur le disque.",
        8 => "Une extension PHP a arrêté l'envoi de picture. 
              PHP ne propose aucun moyen de déterminer quelle extension est en cause. ",
    ];

    const PICTURE = [
        'png',
        'jpe',
        'jpeg',
        'jpg',
        'gif',
        'bmp',
        'ico',
        'tiff',
        'tif',
        'svg',
        'svgz',
        'jfif'
    ];

    const AUDIO_VIDEO = [
        'mp3',
        'qt',
        'mov',
        'mp4',
        'avi'
    ];

    const FILES = [
        'txt',
        'htm',
        'html',
        'php',
        'css',
        'js',
        'json',
        'xml',
        'swf',
        'zip',
        'rar',
        'exe',
        'pdf'
    ];

    public function upload($name, $type, $uploadDir)
    {
        switch ($type) {
            case 'picture':
                $valideExtensions = self::PICTURE;
                break;
            case 'audio':
                $valideExtensions = self::AUDIO_VIDEO;
                break;
            case 'video':
                $valideExtensions = self::AUDIO_VIDEO;
                break;
            case 'file':
                $valideExtensions = self::FILES;
                break;
        }

        $tmpUploadFile = $_FILES[$name]['tmp_name'][0];
        $fileExtension = strtolower(strrchr($_FILES[$name]['name'][0], '.'));

        if (!in_array(substr($fileExtension, 1), $valideExtensions)) {
            $errors[] = "L'extention <b>($fileExtension)</b> du fichier <b>"
                . $_FILES[$name]['name'][0] . "</b> n'est pas valide !";
        }

        if ($tmpUploadFile != "" and empty($errors)) {
            $savedNames[] = $_FILES[$name]['name'][0];
            $uploadFile = $uploadDir . uniqid("$type") . $fileExtension;

            if (move_uploaded_file($tmpUploadFile, $uploadFile)) {
                $newFiles[] = basename($uploadFile);
                $result['success'] = "Le fichier <b>" . $savedNames[0] . "</b> à bien été envoyée.<br/>";
                $result['link'] = $uploadFile;
            }
        }
        if ($_FILES[$name]['error'][0] > 0) {
            $errors[] = "Erreur lors du transfert de " .
                $_FILES[$name]['name'][0] . ".<br/>" .
                self::ERROR[$_FILES[$name]['error'][0]] . ".";
        } else {
            $errors[] = 'Veuillez séléctionner un fichier';
        }
        if (isset($errors)) {
            $result['errors'] = $errors;
        }
        return $result;
    }
}
