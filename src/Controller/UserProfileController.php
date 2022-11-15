<?php

namespace App\Controller;

use App\Model\ModifyUserInfosModel;

class UserProfileController extends AbstractController
{
    public function showUserProfile(): string
    {
        return $this->twig->render('UserProfile/showUserProfile.html.twig');
    }

    public function modifyUserProfile(): string
    {
        $modifyUserInfos = new ModifyUserInfosModel();
        $userKids = $modifyUserInfos->selectKids();
        $kidIDs = [];
        foreach ($userKids as $kids) {
            $kidIDs[] = $kids['kidID'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $infosUser = array_map('trim', $_POST);
            $errors = $this->validateModifiedInfos($infosUser);
            if (empty($errors)) {
                for ($i = 0; $i < \count($kidIDs); $i++) {
                    $kidID = $kidIDs[$i];
                    $modifyUserInfos->updateKidsSpecs($kidID, $infosUser['commentKid' . $i]);
                }
                $modifyUserInfos->modifyUserInfos(
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['telephone'],
                    $_POST['address'],
                    $_POST['email'],
                    $_POST['password']
                );
                header('Location: userProfile');
            } else {
                return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
                    'errors' => $errors,
                    'kids' => $userKids
                ]);
            }
        }
        return $this->twig->render('UserProfile/modifyUserProfile.html.twig', [
            'kids' => $userKids]);
    }

    private function validateModifiedInfos(array $infosUser): array
    {
        $errors = [];
        if (empty($infosUser['firstname'])) {
            $errors[] = 'Prénom obligatoire';
        }
        if (empty($infosUser['lastname'])) {
            $errors[] = 'Nom obligatoire';
        }
        if (empty($infosUser['telephone'])) {
            $errors[] = 'téléphone obligatoire';
        }
        if (empty($infosUser['address'])) {
            $errors[] = 'adresse postale obligatoire';
        }
        if (!filter_var($infosUser['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'E-mail obligatoire';
        }
        if (empty($infosUser['password']) || empty($_POST['password2'])) {
            $errors[] = 'Mot de passe obligatoire';
        } elseif ($infosUser['password'] !== $infosUser['password2']) {
            $errors[] = 'Mot de passe differents';
        }
        return $errors;
    }
}
