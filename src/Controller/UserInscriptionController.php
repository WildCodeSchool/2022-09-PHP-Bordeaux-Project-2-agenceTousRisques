<?php

namespace App\Controller;

use App\Model\UserManager;
use PDO;

class UserInscriptionController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $user = array_map('trim', $_POST);

            $userManager = new UserManager();
            $userManager->insert($user);
            $id = $userManager->getUserID($user);
            $userManager->insertKid($id, $user);


            header('Location:/public/index.php');
            return null;
        }
        return $this->twig->render('userInscription.html.twig');
    }
}
