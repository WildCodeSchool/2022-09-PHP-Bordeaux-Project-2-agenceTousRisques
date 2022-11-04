<?php

namespace App\Controller;

use App\Model\UserManager;

class UserInscriptionController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array_map('trim', $_POST);
            $userManager = new UserManager();
            $errors = $userManager->validFormCompletedUser($user);
            if (sizeof($errors)) {
                $userManager->insertUser($user);
                $id = $userManager->getUserID();
                $userManager->insertKid($id, $user);
                $userManager->insertKid2($id, $user);
                $userManager->insertKid3($id, $user);
                header('Location:/');
                return null;
            } else {
                foreach ($errors as $error) {
                    echo $error;
                }
            }
        }
        return $this->twig->render('Inscription/userInscription.html.twig', ["GET" => $_GET]);
    }
}
