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
                if (!empty($user['firstnameKid2']) && !empty($user['birthdayKid2']) && !empty($user['commentKid2'])) {
                    $userManager->insertKid2($id, $user);
                }
                if (!empty($user['firstnameKid3']) && !empty($user['birthdayKid3']) && !empty($user['commentKid3'])) {
                    $userManager->insertKid3($id, $user);
                }
                header('Location:/home');
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
