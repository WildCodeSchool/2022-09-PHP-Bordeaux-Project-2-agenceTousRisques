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
            $userManager->validFormCompletedUser($user);

            if (empty($errors)) {
                $userManager->insertUser($user);
                $id = $userManager->getUserID($user);
                $userManager->insertKid($id, $user);
                header('Location:/public/index.php');
                return null;
            } else {
                foreach ($errors as $error) {
                    echo $error;
                }
            }
        }
        return $this->twig->render('userInscription.html.twig', ["GET" => $_GET]);
    }
}
