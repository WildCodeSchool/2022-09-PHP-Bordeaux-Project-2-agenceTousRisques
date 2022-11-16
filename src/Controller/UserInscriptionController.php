<?php

namespace App\Controller;

use App\Model\UserManager;

class UserInscriptionController extends AbstractController
{
    public array $errors;

    public function add(): array|string|null
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
                echo "<script>alert('Votre inscription est validée. \\n Vous pouvez vous connecter.')</script>";
                header('Refresh:0 /');
                return null;
            }
        }
        return $this->twig->render('Inscription/userInscription.html.twig', ["GET" => $_GET]);
    }
}
