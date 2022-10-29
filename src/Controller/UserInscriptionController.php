<?php

namespace App\Controller;

use App\Model\UserManager;
use PDO;

class UserInscriptionController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array_map('trim', $_POST);
            if (!isset($user['password']) || (empty(trim($user['password'])))) {
                $errors[] = 'Mot de passe obligatoire';
            }
            if ($user['password'] != $user['password2']) {
                $errors[] = 'Mots de passe différents';
            }
            if (!isset($user['firstname']) || (empty(trim($user['firstname'])))) {
                $errors[] = 'Prénom obligatoire';
            }
            if (!isset($user['lastname']) || (empty(trim($user['lastname'])))) {
                $errors[] = 'Nom obligatoire';
            }
            if (!isset($user['telephone']) || (empty(trim($user['telephone'])))) {
                $errors[] = 'Telephone obligatoire';
            }
            if (!isset($user['address']) || (empty(trim($user['address'])))) {
                $errors[] = 'Telephone obligatoire';
            }
            if (!isset($user['firstnameKid']) || (empty(trim($user['firstnameKid'])))) {
                $errors[] = 'Prénom enfant obligatoire';
            }
            if (!isset($user['birthdayKid']) || (empty(trim($user['birthdayKid'])))) {
                $errors[] = 'Date de naissance enfant obligatoire';
            }
            if (!isset($user['commentKid']) || (empty(trim($user['commentKid'])))) {
                $errors[] = 'Commentaires enfant obligatoire';
            }
            if (empty($errors)) {
                $userManager = new UserManager();
                $userManager->insertUser($user);
                $id = $userManager->getUserID($user);
                $userManager->insertKid($id, $user);
                header('Location:/public/index.php');
                return null;
            }
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error;
                }
            }
        }
        return $this->twig->render('userInscription.html.twig', ["GET" => $_GET]);
    }
}
